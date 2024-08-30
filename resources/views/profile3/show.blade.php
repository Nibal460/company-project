@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <title>Trainee Profile</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            direction: ltr;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            border: 2px solid rgb(57, 190, 239);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 50%;
            height: auto;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info h2 {
            margin-bottom: 10px;
        }
        .profile-info p {
            margin-bottom: 5px;
        }
        
        .user-image {
            display: block;
            margin: 0 auto 20px;
            width: 250px;  /* Fixed width */
            height: 250px; /* Fixed height to match width */
            border-radius: 50%; /* Make it a circle */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            object-fit: cover; /* Ensure the image covers the entire element */
        }
        .qr-code {
            margin: 20px auto;
            width: 250px;
            height: 250px;
        }
        .qr-code svg {
            max-width: 100%;
            height: auto;
        }
        .question {
            margin-top: 20px;
            font-family: 'Rubik', 'Noto Naskh Arabic', sans-serif;
            direction: rtl;
        }
        .choices {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }
        .choices label {
            margin-bottom: 5px;
        }
        .submit-button {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
        .answer-image-container {
            display: none;
            margin-top: 20px;
        }
        .answer-image {
            display: block;
            max-width: 100%;
            height: auto;
        }
       .second-answer-image{
            display: block;
            max-width: 100%;
            height: auto;
        }
        .edit-profile, .logout {
            display: inline-block;
            margin-right: 10px;
            text-decoration: none;
        }
        /* Responsive */
        @media screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }
            .qr-code {
                width: 100px;
                height: 100px;
            }
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: rgb(57, 190, 239);
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }
        .button:hover {
            background-color: rgb(45, 150, 190); /* Darker shade for hover effect */
        }
    </style>
</head>
<body>
<div class="container">
    <img class="logo" src="{{ asset('images/Techturn-logo.png') }}" alt="Logo">
    <a href="{{ route('profile3.edit') }}" class="edit-profile">Edit Profile</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="profile-info">
        <h1>User Profile</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($profile3)
            <h2>Welcome, {{ $profile3->fname }}</h2>

            @if($profile3->user_image)
                <img class="user-image" src="{{ asset('storage/' . $profile3->user_image) }}" alt="{{ $profile3->fname }}'s Profile Picture">
            @else
                <p>No profile picture available.</p>
            @endif

            <p>Your username is: {{ $profile3->username ?? 'N/A' }}</p>
            <p>First Name: {{ $profile3->fname }}</p>
            <p>Last Name: {{ $profile3->lname ?? 'N/A' }}</p>
            <p>Father's Name: {{ $profile3->father_name ?? 'N/A' }}</p>
            <p>Mother's Name: {{ $profile3->mother_name ?? 'N/A' }}</p>
            <p>Email: {{ $profile3->email ?? 'N/A' }}</p>
            <p>Telephone: {{ $profile3->telephone ?? 'N/A' }}</p>
            <p>National Number: {{ $profile3->national_number ?? 'N/A' }}</p>
            <p>Location: {{ $profile3->location ?? 'N/A' }}</p>
            @if($profile3->qr_code_path)
                @php
                    $filePath = 'storage/' . $profile3->qr_code_path;
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

            <p><strong>First Course Name:</strong></p>
            @if($profile3->course2)
                <ul>
                    <li><p><strong>Course Name:</strong> {{ $profile3->course2->name }}</p></li>
                    <li><p><strong>Course Place:</strong> {{ $profile3->course_place }}</p></li>
                    <li><p><strong>Course Time:</strong> {{ $profile3->course_time_hour }}:{{ $profile3->course_time_minute }} {{ $profile3->course_time_ampm }} 
                    {{ Carbon::parse($profile3->course_time_day_month_year)->format('d-m-Y') }}</p></li>
                    <li><p><strong>Course Number:</strong> {{ $profile3->course2->description }}</p></li>
                </ul>
            @else
                <p>No main course assigned</p>
            @endif

            <!-- Additional Courses -->
            <p><strong>Additional Course(s):</strong></p>
            @if($profile3->courseProfile3s->isNotEmpty())
                <ul>
                    @foreach($profile3->courseProfile3s as $course)
                        <li><p><strong>Course Name:</strong> {{ $course->course_name }}</p></li>
                        <li><p><strong>Course Place:</strong> {{ $course->course_place }}</p></li>
                        <li><p><strong>Course Time:</strong> {{ $course->course_time_hour }}:{{ $course->course_time_minute }} {{ $course->course_time_ampm }} {{ Carbon::parse($course->course_time_day_month_year)->format('d-m-Y') }}</p>
                        @if($course->course2)
                            <li><p><strong>Course Description:</strong> {{ $course->course2->description }}</p></li>
                        @else
                            <li><p><strong>Course Description:</strong> Not available</p></li>
                        @endif
                        <p>------------------------</p>
                    @endforeach
                </ul>
            @else
                <p>No additional courses assigned</p>
            @endif
        @endif

        <!-- Link to add course -->
        <a href="{{ route('course.add') }}" class="button">Add a Course</a>

        <div class="question">
            <h3>ما هو المجال الذي تهتم به(اضغط لرؤية المسار اللازم اتباعه):</h3>
            <div class="choices">
                <label><input type="radio" name="choice" value="choice1">تصميم الروبوت</label>
                <label><input type="radio" name="choice" value="choice2">البرمجة الصناعية</label>
                <!--<label><input type="radio" name="choice" value="choice3">صيانة الأجهزة الصناعية</label>-->
                <label><input type="radio" name="choice" value="choice4">برمجة الوب</label>
            </div>
        </div>

        <div class="answer-image-container">
            <img class="answer-image" src="" alt="Answer Image 1">
            <img class="second-answer-image" src="" alt="Answer Image 2">
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize select2
        $('.time-picker').select2();

        // Initialize date picker
        $('.date-picker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });
         // Radio button change event handler
         const choices = document.querySelectorAll('input[name="choice"]');
        const answerImageContainer = document.querySelector('.answer-image-container');
        const answerImage = document.querySelector('.answer-image');
        const secondAnswerImage = document.querySelector('.second-answer-image');

        choices.forEach(choice => {
            choice.addEventListener('change', () => {
                if (choice.value === 'choice1') {
                    answerImage.src = '{{ asset('images/Roadmap4.jpg') }}';
                    secondAnswerImage.src = '{{ asset('images/Roadmap41.jpg') }}';
                    secondAnswerImage.style.display = 'block'; // Show the second image for choice1
                } else if (choice.value === 'choice2') {
                    answerImage.src = '{{ asset('images/Roadmap2.jpg') }}';
                    secondAnswerImage.src = '{{ asset('images/Roadmap3.jpg') }}';
                    secondAnswerImage.style.display = 'block'; // Show the second image for choice2
                } else if (choice.value === 'choice4') {
                    answerImage.src = '{{ asset('images/Roadmap1.jpg') }}';
                    secondAnswerImage.style.display = 'none'; // Hide the second image for other choices
                } else {
                    secondAnswerImage.style.display = 'none'; // Hide the second image for other choices
                }

                answerImageContainer.style.display = 'block'; // Show the answer image container
            });
        });
    });
</script>
</body>
</html>
