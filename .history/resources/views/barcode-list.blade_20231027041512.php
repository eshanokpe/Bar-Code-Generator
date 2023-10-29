<!DOCTYPE html>
<html>
<head>
    <title>Barcode Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <style>
        .container{
            margin-top: 5px;
            width:400px;
            text-align: center;
        }
        .barcode{
            /* padding-top: 5px; */
            /* padding-bottom: 15px; */
            margin-bottom: 20px;
            padding: 20px;
            border:3px solid #000;
        }
        .barcodeData{
            text-align: center;
            letter-spacing: 20px;
            width: 500px;
        }
        .additionalInfo{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        .additionalInfo p {
            margin: 0 40px; 
            /* word-spacing: 40px; */
        }
        .barcode-separate {
            word-spacing: 40px;
         }
    </style>
</head>
<body>
    {{-- <h1>Generated Barcode:</h1> --}}
    
       <center><h3> The Hub Terminal - Storage Location</h3></center>
    <div class="container">
        <form action="/generate-barcode" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Bar Code Generator  </label>
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            var errorMessage = document.getElementById('error-message');
                            if (errorMessage) {
                                errorMessage.style.display = 'none';
                            }
                        }, 5000); // 5000 milliseconds = 5 seconds
                    </script>
                @endif
                <input type="text" name="barcodeData" class="form-control" id="" placeholder="Enter barcode content">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Generate</button>
              </div>
        </form>


        {{-- <h2>The Hub Terminal - Storage Location:</h2> --}}
        <div>
            <div class="barcode-images">
                @foreach ($barcodeImages as $barcodeDataImage)
               
                    <div style="display: flex">
                        <div  class="barcode">
                            <img src="{{ $barcodeDataImage['image'] }}" alt="Barcode">
            
                            {{-- @foreach($barcodes as barcode) --}}
                                <div class="additionalInfo">  
                                    <p class="barcode-separate">{{ $barcodeDataImage['data'] }}</p>
                                </div>
                            <div class="additionalInfo">
                                <p class="">{{ $additionalRack }}</p>
                                <p class="">{{ $additionalLevel }}</p>
                                <p class="">{{ $additionalBay }}</p>
                            </div>
                        </div>
                        <div style="width:900px">

                        </div>
                        <div class="mb-3">
                            <form action="{{ route('barcode.delete', ['id' => $barcodeDataImage['id']]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this barcode?')">Delete</button>
                            </form>
                        </div>
                    </div>
                  
                    
                    

                @endforeach
            </div>
            
        </div>
        
        

        
    </div>
   
   
</body>
</html>
