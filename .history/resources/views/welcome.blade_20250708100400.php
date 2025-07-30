<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .barcode-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .barcode-display {
            margin: 20px 0;
            padding: 15px;
            border: 2px solid #dee2e6;
            border-radius: 5px;
            background: white;
        }
        .barcode-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
        .barcode-data {
            font-family: monospace;
            font-size: 18px;
            letter-spacing: 3px;
            text-align: center;
            margin-bottom: 10px;
        }
        .barcode-labels {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
            font-weight: bold;
        }
        .format-examples {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="barcode-container">
            <h2 class="text-center mb-4">Barcode Generator</h2>
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="format-examples">
                <h5>Valid Formats:</h5>
                <ul>
                    <li><strong>Rack/Level/Bay:</strong> R01 - L2 - C </li>
                    <li><strong>PR Format:</strong> PR01/A</li>
                </ul>
            </div>

            <form action="{{ route('generate-barcode') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="barcodeInput" class="form-label">Enter barcode content</label>
                    <input type="text" name="barcodeData" class="form-control" id="barcodeInput" 
                           placeholder="Example: R01/Level 2/C" value="{{ old('barcodeData') }}" required>
                    @error('barcodeData')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Generate Barcode</button>
                    <a href="{{ route('list-barcodes') }}" class="btn btn-secondary">View All Barcodes</a>
                </div>
            </form>

            @isset($barcode)
            <div class="barcode-display mt-4">
                <h4 class="text-center">Generated Barcode</h4>
                <img src="{{ $barcode }}" alt="Barcode" class="barcode-image mx-auto d-block">
                
                <div class="barcode-data">
                    {{ $barcodeData ?? '' }}
                </div>
                
                <div class="barcode-labels">
                    <span>{{ $additionalRack ?? 'Rack' }}</span>
                    <span>{{ $additionalLevel ?? 'Level' }}</span>
                    <span>{{ $additionalBay ?? 'Bay' }}</span>
                </div>
                
                <div class="barcode-labels mt-2">
                    <span>{{ $datacode['RO1'] ?? 'R01' }}</span>
                    <span>{{ $datacode['L2'] ?? 'L2' }}</span>
                    <span>{{ $datacode['C'] ?? 'C' }}</span>
                </div>
            </div>
            @endisset
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>