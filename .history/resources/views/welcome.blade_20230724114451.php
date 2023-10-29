<!DOCTYPE html>
<html>
<head>
    <title>Barcode Display</title>
</head>
<body>
    <h1>Generated Barcode:</h1>
    <img src="{{ $barcode }}" alt="Barcode">
    <p>{{ $barcodeData }}</p>
    <p style="padding-left: 0px">{{ $additionalInfo }}</p>
</body>
</html>
