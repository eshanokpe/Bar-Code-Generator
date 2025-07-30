<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Str;

class BarcodeController extends Controller
{
    public function index()
    {
        // Sample data for the welcome page
        $location = 'R01';
        $level = 'L2';
        $bay = 'C';
        $barcodeData = "$location-$level-$bay";
        
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = 'data:image/png;base64,' . base64_encode(
            $generator->getBarcode($barcodeData, $generator::TYPE_CODE_128)
        );

        $data = [
            'barcode' => $barcodeImage,
            'barcodeData' => $barcodeData,
            'additionalRack' => "Rack",
            'additionalLevel' => "Level",
            'additionalBay' => "Bay",
            'sampleFormats' => [
                'Rack/Level/Bay' => 'R01/Level 2/C',
                'PR Format' => 'PR01/A'
            ]
        ];

        return view('welcome', $data);
    }

    use Illuminate\Database\QueryException; // Add this at the top of your controller

public function generateBarcode(Request $request)
{
    // Get the barcode data from the form input
    $barcodeData = trim($request->input('barcodeData'));
    
    // Define regular expression patterns for both "R01 - L2 - C1" and "PR01/A" formats
    $patternR = '/^R(\d{2})\s*-\s*L(\d)\s*-\s*(\w\d)$/';
    $patternPR = '/^PR(\d{2})\/(\w)$/';

    if (preg_match($patternR, $barcodeData, $matchesR)) {
        // Format the barcode data as "R01 - L2 - C1"
        $formattedBarcodeData = 'R' . $matchesR[1] . ' - L' . $matchesR[2] . ' - ' . $matchesR[3];
    }
    // Check if the input matches the "PR01/A" format
    elseif (preg_match($patternPR, $barcodeData, $matchesPR)) {
        // Format the barcode data as "PR01 - A"
        $formattedBarcodeData = 'PR' . $matchesPR[1] . ' - ' . $matchesPR[2];
    } else {
        // Handle invalid input format
        return redirect()->back()
            ->withInput()
            ->with('error', 'Invalid format. Valid formats: R01 - L2 - C1 or PR01/A');
    }

    try {
        // Generate the barcode image using the formatted input data
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = 'data:image/png;base64,' . base64_encode(
            $generator->getBarcode($formattedBarcodeData, $generator::TYPE_CODE_128)
        );

        // Save the barcode data to the database
        $barcode = new Barcode();
        $barcode->barcode_data = $formattedBarcodeData;
        $barcode->barcode_image = $barcodeImage;
        $barcode->save();

        return redirect()->route('list-barcodes')
            ->with('success', 'Barcode created successfully');
            
    } catch (QueryException $e) {
        // Check if the error is due to a duplicate entry
        if ($e->errorInfo[1] == 1062) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'This barcode already exists!');
        }
        
        // If it's another database error, return a generic message
        return redirect()->back()
            ->withInput()
            ->with('error', 'An error occurred while saving the barcode.');
    }
}

    public function showBarcodes()
    {
        $barcodes = Barcode::latest()->paginate(10);

        // Generate barcode images for each barcode
        $barcodes->getCollection()->transform(function ($barcode) {
            $generator = new BarcodeGeneratorPNG();
            $barcode->image = 'data:image/png;base64,' . base64_encode(
                $generator->getBarcode($barcode->barcode_data, $generator::TYPE_CODE_128)
            );
            return $barcode;
        });

        return view('barcode-list', [
            'barcodes' => $barcodes,
            'additionalRack' => "Rack",
            'additionalLevel' => "Level",
            'additionalBay' => "Bay"
        ]);
    }

    public function deleteBarcode($id)
    {
        $barcode = Barcode::findOrFail($id);
        $barcode->delete();

        return redirect()->route('list-barcodes')
            ->with('success', 'Barcode deleted successfully');
    }

    /**
     * Format the barcode data based on input patterns
     */
    private function formatBarcodeData($input)
    {
        // Pattern for R01/Level 2/C format
        if (preg_match('/^R(\d{2})\/Level (\d)\/(\w)$/i', $input, $matches)) {
            return sprintf('R%s - L%s - %s', 
                str_pad($matches[1], 2, '0', STR_PAD_LEFT), 
                $matches[2], 
                strtoupper($matches[3])
            );
        }

        // Pattern for PR01/A format
        if (preg_match('/^PR(\d{2})\/(\w)$/i', $input, $matches)) {
            return sprintf('PR%s - %s', 
                str_pad($matches[1], 2, '0', STR_PAD_LEFT), 
                strtoupper($matches[2])
            );
        }

        return false;
    }
}