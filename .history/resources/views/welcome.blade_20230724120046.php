<!DOCTYPE html>
<html>
<head>
    <title>Barcode Display</title>
</head>
<body>
    {{-- <h1>Generated Barcode:</h1> --}}
    <div style="border:3px solid #8ebf42; padding-right:30px">
        <img src="{{ $barcode }}" alt="Barcode">
        <p>{{ $barcodeData }}</p>
        <p style="padding-left: 0px">{{ $additionalInfo }}</p>
    </div>
   
</body>
</html>
