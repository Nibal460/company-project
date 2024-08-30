<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Trainer Profile</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 2px solid rgb(57, 190, 239);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        h1, h2 {
            text-align: center;
        }
        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            margin: 0 auto 20px;
            padding: 10px;
            background-color: rgb(57, 190, 239);
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }
        .logout-btn i {
            margin-left: 8px;
        }
        .logout-btn:hover {
            background-color: rgb(47, 170, 219);
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/techturn-logo.png') }}" alt="Logo" class="logo">
        <a href="{{ route('teacher.logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout <i class="fas fa-sign-out-alt"></i>
        </a>

        <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <h1>
            Hello 
            @if($teacher->gender == 'Male') 
                Mr. 
            @else 
                Miss 
            @endif 
            {{ $teacher->first_name }}
        </h1>
        <p>First Name: {{ $teacher->first_name }}</p>
        <p>Last Name: {{ $teacher->last_name }}</p>
        <p>Email: {{ $teacher->email }}</p>
        <p>Gender: {{ $teacher->gender }}</p>

        <p><strong>Trainer QR Code:</strong></p>
        @if($teacher->qr_code_path)
            @php
                $filePath = 'storage/' . $teacher->qr_code_path;
                $fullPath = public_path($filePath);
                $svgContent = file_exists($fullPath) ? file_get_contents($fullPath) : null;
            @endphp

            @if($svgContent)
                <div class="qr-code">
                    {!! $svgContent !!}
                </div>
            @else
                <p>QR code file does not exist at {{ $fullPath }}</p>
            @endif
        @else
            <p>No QR code path set</p>
        @endif
    </div>
</body>
</html>
