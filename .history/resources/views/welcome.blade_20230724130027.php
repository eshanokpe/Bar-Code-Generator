<!DOCTYPE html>
<html>
<head>
    <title>Barcode Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
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
        <h1>Generate Barcode</h1>
        <form action="/generate-barcode" method="post">
            @csrf
            <input class="form-" type="text" name="barcodeData" placeholder="Enter barcode content">
            <button type="submit">Generate</button>
        </form>

        <div  class="barcode">
            <img src="{{ $barcode }}" alt="Barcode">
            {{-- <p class="barcodeData">{{ $barcodeData }}</p> --}}
           
            <div class="additionalInfo">
                <p>{{ $datacode['RO1'] }}</p> -  
                <p>{{ $datacode['L2'] }}</p> -
                <p>{{ $datacode['C'] }}</p>
            </div>
            <div class="additionalInfo">
                <p class="">{{ $additionalRack }}</p>
                <p class="">{{ $additionalLevel }}</p>
                <p class="">{{ $additionalBay }}</p>
            </div>
           
        </div>
    </div>
   
   
</body>
</html>
