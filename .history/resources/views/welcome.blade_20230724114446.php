<!DOCTYPE html>
<html>
<head>
    <title>Barcode Display</title>
</head>
<body>
    <h1>Generated Barcode:</h1>
    <img src="{{ $barcode }}" alt="Barcode">
    <p>{{ $barcodeData }}</p>
    <p style="padding-left: 100px">{{ $additionalInfo }}</p>
</body>
</html>
