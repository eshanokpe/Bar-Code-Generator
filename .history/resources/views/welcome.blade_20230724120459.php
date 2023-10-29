<!DOCTYPE html>
<html>
<head>
    <title>Barcode Display</title>
    <style>
        .container{
            width:300px;
            text: center;
        }
        .barcode{
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
