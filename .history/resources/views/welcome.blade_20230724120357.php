<!DOCTYPE html>
<html>
<head>
    <title>Barcode Display</title>
    <style>
        .container{
            width:300px;
        }
    </style>
</head>
<body>
    {{-- <h1>Generated Barcode:</h1> --}}
    <div class="container">
        <div  class="">
            <img src="{{ $barcode }}" alt="Barcode">
            <p>{{ $barcodeData }}</p>
            <p style="padding-left: 0px">{{ $additionalInfo }}</p>
        </div>
    </div>
   
   
</body>
</html>
