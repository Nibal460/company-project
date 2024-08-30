<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Trainer details</title>
    <style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px solid rgb(57, 190, 239); /* Added border color */
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 230px; /* Set a maximum width for the logo */
            width: 100%;
            height: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            margin: 10px 0;
        }

        strong {
            font-weight: bold;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: rgb(57, 190, 239);
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            width: 48%; /* Ensure the buttons are half-width */
            box-sizing: border-box; /* Include padding and border in the element's total width */
        }

        .btn:hover {
            background-color: rgb(47, 170, 219);
        }

        .qr-code {
            display: block;
            margin: 20px auto;
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 10px;
            }

            p {
                margin: 5px 0;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }

            .btn:last-child {
                margin-bottom: 0;
            }
        }
    </style>
</head>
<body>
<div class="container">
   

    <!-- Logo -->
    <img class="logo" src="{{ asset('images/techturn-logo.png') }}" alt="Logo">
    <h1>User Details</h1>
    <!-- User Information -->
    @if($user->user_image)
        <img class="user-image" src="{{ asset('storage/' . $user->user_image) }}" alt="{{ $user->fname }}'s Profile Picture">
    @else
        <p>No profile picture available.</p>
    @endif
    <p><strong>User ID:</strong> {{ $user->id }}</p>
    <p><strong>First Name:</strong> {{ $user->fname }}</p>
    <p><strong>Last Name:</strong> {{ $user->lname }}</p>
    <p><strong>User Name:</strong> {{ $user->username }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Telephone:</strong> {{ $user->telephone }}</p>
    <p><strong>Location:</strong> {{ $user->location }}</p>
    <p><strong>Course Place:</strong> {{ $user->course_place }}</p>
    <p><strong>Course Name:</strong> {{ $user->course2->name }}</p>
    <p><strong>User QRcode:</strong></p>
    @if($user && $user->qr_code_path)
        @php
            // Correct file path relative to public directory
            $filePath = 'storage/' . $user->qr_code_path;
            $fullPath = public_path($filePath);
            $svgContent = file_exists($fullPath) ? file_get_contents($fullPath) : null;
        @endphp

        @if($svgContent)
            <div class="qr-code">
                <!-- Display SVG QR code by embedding SVG content -->
                {!! $svgContent !!}
            </div>
        @else
            <p>QR code file does not exist at {{ $fullPath }}</p>
        @endif
    @else
        <p>No QR code path set</p>
    @endif

    <div class="btn-group">
        <!-- Download QR Code Button -->
        <a href="{{ route('admin.users.downloadQrCode', $user->id) }}" class="btn">Download QR Code</a>

        <!-- Back to Admin Button -->
        <a href="{{ route('teacher.profile') }}" class="btn">Back to Admin</a>
    </div>
</div>
</body>
</html>
