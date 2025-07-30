<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Hub Terminal - Barcode Management</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logothl.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        
        .header {
            background: linear-gradient(135deg, var(--secondary-color), #1a252f);
            color: white;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
        }
        
        .header h3 {
            font-weight: 600;
            margin: 0;
        }
        
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
        }
        
        .form-title {
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .form-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .barcode-card {
            display: flex;
            align-items: center;
            padding: 1.5rem;
        }
        
        .barcode-image-container {
            flex: 0 0 50px;
            text-align: center;
            padding: 1rem;
            background: var(--light-gray);
            border-radius: var(--border-radius);
            margin-right: 1.5rem;
        }
        
        .barcode-image {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
        
        .barcode-details {
            flex: 1;
        }
        
        .barcode-data {
            font-family: 'Courier New', monospace;
            font-size: 1.1rem;
            font-weight: bold;
            letter-spacing: 2px;
            color: var(--secondary-color);
            margin-bottom: 1rem;
            word-break: break-all;
            background: var(--light-gray);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            display: inline-block;
        }
        
        .barcode-labels {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .barcode-label {
            font-weight: 600;
            color: var(--secondary-color);
            display: flex;
            align-items: center;
        }
        
        .barcode-label i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }
        
        .barcode-meta {
            color: #6c757d;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }
        
        .barcode-meta i {
            margin-right: 0.5rem;
        }
        
        .barcode-actions {
            flex: 0 0 10px;
            display: flex;
            justify-content: center;
        }
        
        .btn-danger {
            background-color: var(--accent-color);
            border: none;
            transition: var(--transition);
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
        }
        
        .pagination {
            justify-content: center;
            margin-top: 2rem;
        }
        
        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .page-link {
            color: var(--secondary-color);
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }
        
        .empty-state i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .flash-message {
            animation: fadeOut 5s forwards;
            animation-delay: 2s;
            border-left: 4px solid;
        }
        
        .alert-danger {
            border-left-color: var(--accent-color);
        }
        
        .alert-success {
            border-left-color: #2ecc71;
        }
        
        @keyframes fadeOut {
            to { opacity: 0; height: 0; padding: 0; margin: 0; overflow: hidden; }
        }
        
        @media (max-width: 768px) {
            .barcode-card {
                flex-direction: column;
                text-align: center;
            }
            
            .barcode-image-container {
                margin-right: 0;
                margin-bottom: 1.5rem;
                width: 100%;
            }
            
            .barcode-labels {
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .barcode-actions {
                margin-top: 1.5rem;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container text-center">
            <h3><i class="bi bi-upc-scan"></i> The Hub Terminal - Storage Location</h3>
        </div>
    </div>

    <div class="main-container">
        <div class="form-container">
            <h4 class="form-title"><i class="bi bi-qr-code"></i> Barcode Generator</h4>
            
            @if(session('error'))
                <div class="alert alert-danger flash-message">
                    <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success flash-message">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('generate-barcode') }}" method="post">
                @csrf
                <div class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <label for="barcodeInput" class="form-label">Enter barcode content</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-tag-fill"></i></span>
                            <input type="text" name="barcodeData" class="form-control" id="barcodeInput" 
                                   placeholder="Example: R01 - L2 - CA or PR01/A" value="{{ old('barcodeData') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Generate Barcode
                        </button>
                    </div>
                </div>
                <div class="mt-3 text-muted">
                    <small><i class="bi bi-info-circle"></i> Valid formats: R01 - L2 - CA  or PR01/A</small>
                </div>
            </form>
        </div>

        <h4 class="form-title"><i class="bi bi-list-ul"></i> Generated Barcodes</h4>
        
        @if($barcodes->isEmpty())
            <div class="empty-state card">
                <i class="bi bi-upc"></i>
                <h5>No barcodes generated yet</h5>
                <p class="text-muted">Create your first barcode using the form above</p>
            </div>
        @else
            @foreach ($barcodes as $barcode)
                <div class="barcode-card card">
                    <div class="barcode-image-container">
                        <img src="{{ $barcode->image }}" alt="Barcode" class="barcode-image">
                    </div>
                    
                    <div class="barcode-details">
                        <div class="barcode-data">{{ $barcode->barcode_data }}</div>
                        
                        <div class="barcode-labels">
                            <span class="barcode-label">
                                <i class="bi bi-box-seam"></i> {{ $additionalRack }}
                            </span>
                            <span class="barcode-label">
                                <i class="bi bi-layer-forward"></i> {{ $additionalLevel }}
                            </span>
                            <span class="barcode-label">
                                <i class="bi bi-grid-3x3-gap"></i> {{ $additionalBay }}
                            </span>
                        </div>
                        
                        <div class="barcode-meta">
                            <i class="bi bi-clock"></i>
                            <span>Created: {{ $barcode->created_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                    
                    <div class="barcode-actions">
                        <form action="{{ route('delete-barcode', ['id' => $barcode->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this barcode?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            <div class="mt-4">
                {{ $barcodes->links() }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>