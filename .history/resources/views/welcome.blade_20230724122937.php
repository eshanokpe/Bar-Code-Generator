<!DOCTYPE html>
<html>
<head>
    <title>Barcode Display</title>
    <style>
        .container{
            margin-top: 5px;
            width:300px;
            text-align: center;
        }
        .barcode{
            padding-top: 5px;
            border:3px solid #000;
        }
        .barcodeData{
            text-align: center;
            letter-spacing: 20px;
            width: 300px;
        }
        .additionalInfo{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        .additionalInfo p {
            margin: 0 30px; /* Add some horizontal spacing between paragraphs */
        }
    </style>
</head>
<body>
    {{-- <h1>Generated Barcode:</h1> --}}
    <div class="container">
        <div  class="barcode">
            <img src="{{ $barcode }}" alt="Barcode">
            <p class="barcodeData">{{ $barcodeData }}</p>
            <p></p>
            <div class="additionalInfo">
                <p class="">{{ $additionalRack }}</p>
                <p class="">{{ $additionalLevel }}</p>
                <p class="">{{ $additionalBay }}</p>
            </div>
           
        </div>
    </div>
   
   
</body>
</html>
