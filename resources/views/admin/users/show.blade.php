@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Admin - Student Details</title>
    <style>
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
            border: 2px solid rgb(57, 190, 239);
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 230px;
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
            width: 48%;
            box-sizing: border-box;
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
    <h1>Trainee Details</h1>
    <!-- User Information -->
    @if($user->user_image)
        <img class="user-image" src="{{ asset('storage/' . $user->user_image) }}" alt="{{ $user->fname }}'s Profile Picture">
    @else
        <p>No profile picture available.</p>
    @endif
    <p><strong>Trainee ID:</strong> {{ $user->id }}</p>
    <p><strong>First Name:</strong> {{ $user->fname }}</p>
    <p><strong>Last Name:</strong> {{ $user->lname }}</p>
    <p><strong>Father Name:</strong> {{ $user->father_name }}</p>
    <p><strong>Mother Name:</strong> {{ $user->mother_name }}</p>
    <p><strong>National Number:</strong> {{ $user->national_number }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Telephone:</strong> {{ $user->telephone }}</p>
    <p><strong>Location:</strong> {{ $user->location }}</p>
    <p><strong>First Course Name:</strong></p>
    @if($user->course2)
    <ul>
        <li>
            <p><strong>Course Name:</strong> {{ $user->course2->name }}</p>
            <a href="{{ route('admin.users.certificateDate', ['user' => $user->id, 'course2' => $user->course2->id]) }}" target="_blank" class="btn">Generate Certificate</a>
           

        </li>      
           <li><p><strong>Course Place:</strong> {{ $user->course_place }}</p></li>
        <li><p><strong>Course Time:</strong> {{ $user->course_time_hour }}:{{ $user->course_time_minute }} {{ $user->course_time_ampm }} {{ Carbon::parse($user->course_time_day_month_year)->format('d-m-Y') }}</p></li>
        <li><p><strong>Course Description:</strong> {{ $user->course2->description }}</p></li>
    </ul>
    @else
        <p>No main course assigned</p>
    @endif

   
    <!-- Additional Courses -->
    <p><strong>Additional Course(s):</strong></p>
    @if($user->profile3 && $user->profile3->courseProfile3s->isNotEmpty())
    <ul>
    @foreach($user->profile3->courseProfile3s as $courseProfile3)
    <li>
        <p><strong>Course Name:</strong> {{ $courseProfile3->course_name }}</p>
        <a href="{{ route('admin.users.additionalCertificateDate', ['user' => $user->id, 'courseProfile3' => $courseProfile3->id]) }}" target="_blank" class="btn">Generate Certificate</a>
    </li>
    <li><p><strong>Course Place:</strong> {{ $courseProfile3->course_place }}</p></li>
    <li><p><strong>Course Time:</strong> {{ $courseProfile3->course_time_hour }}:{{ $courseProfile3->course_time_minute }} {{ $courseProfile3->course_time_ampm }} {{ Carbon::parse($courseProfile3->course_time_day_month_year)->format('d-m-Y') }}</p></li>
    @if($courseProfile3->course2)
    <li><p><strong>Course Description:</strong> {{ $courseProfile3->course2->description }}</p></li>
    @else
    <li><p><strong>Course Description:</strong> Not available</p></li>
    @endif
    <p>------------------------</p>
    @endforeach
    </ul>
    @else
    <p>No additional courses assigned</p>
    @endif


    <p><strong>Trainee QR Code:</strong></p>
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
        <a href="{{ route('admin.users.index') }}" class="btn">Back to Admin</a>
    </div>
</div>
</body>
</html>
