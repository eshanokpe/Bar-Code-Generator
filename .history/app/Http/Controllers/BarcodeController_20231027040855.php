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
        // Define a regular expression pattern to match and format the input data
        $pattern = '/^R(\d{2})\/Level (\d)\/(\w)/';
        if (preg_match($pattern, $barcodeData, $matches)) {
            // Convert the date format from "R01/Level 2/C" to "R01 - L2 - C"
            $barcodeDataParts = explode('/', $barcodeData);
            $formattedBarcodeData = $barcodeDataParts[0] . ' - ' . str_replace('Level ', 'L', $barcodeDataParts[1]) . ' - ' . $barcodeDataParts[2];
            
            // Generate the barcode image using the input data
            $generator = new BarcodeGeneratorPNG();
            $barcodeImage = 'data:image/png;base64,' . base64_encode($generator->getBarcode($barcodeData, $generator::TYPE_CODE_128));

            // Save the barcode data to the database
            $barcode = new Barcode();
            $barcode->barcode_data = $formattedBarcodeData;
            $barcode->save();
        
            return redirect()->route('list-barcodes');
            // return view('barcode', compact('barcodeImage', 'barcodeData', 'additionalInfo', 'barcodes'));
        }else{
             // Handle invalid input format
            return redirect()->back()->with('error', 'Invalid input format');
        }
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
