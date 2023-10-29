<!DOCTYPE html>
<html>
<head>
    <title>Barcode Display</title>
    <style>
        </
</head>
<body>
    {{-- <h1>Generated Barcode:</h1> --}}
    <div class="container">
        <div style="border:3px solid #8ebf42; margin-right:200px">
            <img src="{{ $barcode }}" alt="Barcode">
            <p>{{ $barcodeData }}</p>
            <p style="padding-left: 0px">{{ $additionalInfo }}</p>
        </div>
    </div>
   
   
</body>
</html>
