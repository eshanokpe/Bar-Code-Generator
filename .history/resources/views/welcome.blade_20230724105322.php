<!DOCTYPE html>
<html>
<head>
    <title>Barcode Display</title>
</head>
<body>
    <h1>Generated Barcode:</h1>
    <img src="data:image/png;base64,{{ base64_encode($barcode) }}" alt="Barcode">

</body>
</html>
