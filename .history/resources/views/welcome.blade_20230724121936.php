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
            text-align: center;
            width: 300px;
        }
    </style>
</head>
<body>
    {{-- <h1>Generated Barcode:</h1> --}}
    <div class="container">
        <div  class="barcode">
            <img src="{{ $barcode }}" alt="Barcode">
            <p class="barcodeData">{{ $barcodeData }}</p>
            <div>
                <p class="additionalInfo">{{ $additionalInfo }}</p>
                <p class="additionalInfo">{{ $additionalInfo }}</p>
                <p class="additionalInfo">{{ $additionalInfo }}</p>
            </div>
           
        </div>
    </div>
   
   
</body>
</html>
