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
    </style>
</head>
<body>
    {{-- <h1>Generated Barcode:</h1> --}}
    <div class="container">
        <div  class="barcode">
            <img src="{{ $barcode }}" alt="Barcode">
            <p>{{ $barcodeData }}</p>
            <p style="padding-left: 0px">{{ $additionalInfo }}</p>
        </div>
    </div>
   
   
</body>
</html>
