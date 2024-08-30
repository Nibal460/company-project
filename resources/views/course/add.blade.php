<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Add Course</title>
    <!-- Include necessary CSS and JS files here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            display: flex; /* Use flexbox */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            min-height: 100vh; /* Full viewport height */
            overflow: hidden; /* Prevent scrollbars */
        }

        /* Container styling */
        .container {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 2px solid rgb(57, 190, 239);
            overflow-y: auto; /* Prevent scrollbars */
            position: relative; /* Ensure proper positioning */
        }

        .error-message, .success-message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        /* Form styling */
        form div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: black; /* Label color */
        }
        select, input[type="text"], button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Ensure padding is included in width */
        }
        select.select2 {
            width: 100% !important;
        }
        input#course_time_day_month_year {
            width: 100%; /* Ensure the date field does not cause overflow */
        }

        /* Button styling */
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button, .button-group a {
            width: calc(40% - 5px); /* Adjusted width */
            background-color: rgb(57, 190, 239);
            color: white;
            border: none;
            cursor: pointer;
            padding: 12px; /* Adjusted padding */
            font-size: 16px; /* Adjusted font size */
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        button:hover, .button-group a:hover {
            background-color: rgba(57, 190, 239, 0.9);
        }

        /* Adjusted margin between buttons */
        button:first-child {
            margin-right: 10px; /* Adjusted margin */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                max-width: 90%; /* Adjust container width for smaller screens */
                padding: 15px;
            }
            .button-group {
                flex-direction: column;
            }
            button, .button-group a {
                width: 100%;
                margin-bottom: 10px;
                margin-right: 0; /* Reset margin */
            }
            button:first-child {
                margin-right: 0; /* No margin between buttons in column layout */
            }
        }

        @media (max-width: 480px) {
            .container {
                max-width: 100%; /* Adjust container width for very small screens */
                padding: 10px;
            }
            label, button, .button-group a {
                font-size: 14px; /* Adjust font size for smaller screens */
            }
            button, .button-group a {
                padding: 10px; /* Further adjust padding for smaller screens */
            }
        }

        @media (max-width: 320px) {
            label, button, .button-group a {
                font-size: 12px; /* Further adjust font size for very small screens */
            }
            .container {
                padding: 5px;
            }
        }
    </style>

    <!-- Include jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Include jQuery UI JS -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <div class="container">
        <center><h1>Add Course</h1></center>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('course.add') }}" method="POST">
            @csrf
            <div>
                <label for="course_place">Course Place:</label>
                <select id="course_place" name="course_place" class="select2" required>
                    <option value="">Select a place</option>
                    <option value="Damascus" {{ old('course_place') == 'Damascus' ? 'selected' : '' }}>Damascus</option>
                    <option value="Homs" {{ old('course_place') == 'Homs' ? 'selected' : '' }}>Homs</option>
                    <option value="Deir Attieh" {{ old('course_place') == 'Deir Attieh' ? 'selected' : '' }}>Deir Attieh</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div>
                <label for="course_name">Course Name:</label>
                <select id="course_name" name="course_name" class="select2" required>
                    <option value="">Select a course</option> <!-- Add default option -->
                    @foreach ($courses as $course)
                        <option value="{{ $course->name }}" {{ old('course_name') == $course->name ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="course_time_hour">Course Time (Hour)</label>
                <div class="datetime-container">
                    <select id="course_time_hour" name="course_time_hour" class="time-picker form-control">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ old('course_time_hour') == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="course_time_minute">Course Time (Minute)</label>
                <div class="datetime-container">
                    <select id="course_time_minute" name="course_time_minute" class="time-picker form-control">
                        @for ($i = 0; $i < 60; $i += 15)
                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ old('course_time_minute') == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div>
                <label for="course_time_ampm">AM/PM:</label>
                <select id="course_time_ampm" name="course_time_ampm" required>
                    <option value="AM" {{ old('course_time_ampm') == 'AM' ? 'selected' : '' }}>AM</option>
                    <option value="PM" {{ old('course_time_ampm') == 'PM' ? 'selected' : '' }}>PM</option>
                </select>
            </div>

            <div>
                <label for="course_time_day_month_year">Course Date:</label>
                <input type="text" id="course_time_day_month_year" name="course_time_day_month_year" value="{{ old('course_time_day_month_year') }}" required>
            </div>

            <div class="button-group">
                <button type="submit">Add Course</button>
                <a href="{{ route('profile.show', 3) }}" class="button">Back to Profile</a>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                tags: false, // Disable tagging
                allowClear: false // Disable clearing
            });
            $('#course_time_day_month_year').datepicker({
                dateFormat: 'dd-mm-yy'
            });
        });
    </script>
</body>
</html>
