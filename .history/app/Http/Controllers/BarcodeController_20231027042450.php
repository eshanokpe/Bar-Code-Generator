<?php

namespace App\Http\Controllers;

use App\Models\barcode;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Picqer\Barcode\BarcodeGeneratorPNG;

class BarcodeController extends Controller
{
    //
    public function index(){
       // Generate a Code128 barcode with the data "123456789"
        // Convert the alphanumeric data to a numeric value
        //$numericData = ('WH/Stock/RO1/Level 2/C');
    // Shorten and format the barcode data
    $location = 'R01';
    $level = 'L2';
    $bay = 'C';
    $barcodeData = "$location-$level-$bay"; // Format the data as 'RO1-L2-C'
    
    // Generate the barcode image
    $generator = new BarcodeGeneratorPNG();
    $barcode = 'data:image/png;base64,' . base64_encode($generator->getBarcode($barcodeData, $generator::TYPE_CODE_128));

    // Additional information to be displayed below the barcode
    // $additionalInfo = "Rack Level Bay";
    $additionalRack = "Rack";
    $additionalLevel = "Level";
    $additionalBay = "Bay";
    $datacode=[
        'RO1' => 'R01',
        'L2' => 'L2',
        'C' => 'C',
    ];

    return view('welcome', compact('barcode', 'datacode', 'barcodeData', 'additionalRack', 'additionalLevel', 'additionalBay'));
    }

    public function generateBarcode(Request $request)
    {
        // Get the barcode data from the form input
        $barcodeData = $request->input('barcodeData');
        // Define regular expression patterns for both "R01 - L2 - C" and "PR01/A" formats
        $patternR = '/^R(\d{2})\/Level (\d)\/(\w)/';
        $patternPR = '/^PR(\d{2})\/(\w)/';
        if (preg_match($patternR, $barcodeData, $matchesR)) {
              // Format the barcode data as "R01 - L2 - C"
            $formattedBarcodeData = 'R' . $matchesR[1] . ' - L' . $matchesR[2] . ' - ' . $matchesR[3];
            // return view('barcode', compact('barcodeImage', 'barcodeData', 'additionalInfo', 'barcodes'));
        }
        // Check if the input matches the "PR01/A" format
        elseif (preg_match($patternPR, $barcodeData, $matchesPR)) {
            // Format the barcode data as "PR01 - A"
            $formattedBarcodeData = 'PR' . $matchesPR[1] . ' - ' . $matchesPR[2];
        }else{
             // Handle invalid input format
            return redirect()->back()->with('error', 'Invalid character format');
        }
        // Generate the barcode image using the formatted input data
    $generator = new BarcodeGeneratorPNG();
    $barcodeImage = 'data:image/png;base64,' . base64_encode($generator->getBarcode($formattedBarcodeData, $generator::TYPE_CODE_128));

    // Save the barcode data to the database
    $barcode = new Barcode();
    $barcode->barcode_data = $formattedBarcodeData;
    $barcode->save();
    return redirect()->route('list-barcodes');
    }

    public function showBarcodes()
    {
        // Retrieve all barcode data from the database
        $barcodes = Barcode::latest()->get();

        
        // Additional information to be displayed below the barcode
        $additionalInfo = "Rack Level Bay";
        $datacode=[
            'RO1' => 'R01',
            'L2' => 'L2',
            'C' => 'C',
        ];
        $additionalRack = "Rack";
        $additionalLevel = "Level";
        $additionalBay = "Bay";

        // Generate barcode images for each entry in $barcodes collection
        $barcodeImages = [];
        foreach ($barcodes as $barcode) {
            $generator = new BarcodeGeneratorPNG();
            $barcodeImage = 'data:image/png;base64,' . base64_encode($generator->getBarcode($barcode->barcode_data, $generator::TYPE_CODE_128));
            $barcodeImages[] = [
                'image' => $barcodeImage,
                'data' => $barcode->barcode_data,
                'id' => $barcode->id,
            ];
        }

        return view('barcode-list', compact('barcodes','barcodeImages', 'datacode', 'additionalRack', 'additionalLevel', 'additionalBay'));
    }

    public function deleteBarcode($id)
    {
        // Find the barcode record by its ID
        $barcode = Barcode::find($id);

        // If the barcode record exists, delete it
        if ($barcode) {
            $barcode->delete();
            // Optionally, you can add a success message
            return redirect()->back()->with('success', 'Barcode deleted successfully.');
        } else {
            // Optionally, you can add an error message
            return redirect()->back()->with('error', 'Barcode not found or already deleted.');
        }
    }
   

}
