<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>CEO QR Code</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            box-shadow: 0 4px #999;
        }
        .btn-primary:hover {
            background-color: #0069d9;
        }
        .btn-secondary {
            margin-left: 10px;
        }
        img {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>QR Code for {{ $ceo->first_name }} {{ $ceo->last_name }}</h1>
        <img src="{{ asset('storage/' . $ceo->qr_code_path) }}" alt="QR Code">
        <div class="btn-group">
            <a href="{{ route('admin.ceos.create') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</body>
</html>
