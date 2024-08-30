<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainee registration</title>
    <!-- Include QR Code generator library -->
    <!-- Include libraries for the datetime picker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.css">
    <!-- Include jQuery and jQuery UI -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   
</head>
<body>
    <div class="animated">
        <div class="animated2"></div>
        <div class="mainContainer">
            <h1>Welcome To TechTurn Company</h1>
            
            <form id="registration-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <p> You have an account? <a href="{{ route('login') }}">Login now</a></p>
                <input type="text" name="fname" id="fname" placeholder="First name/الاسم الأول" required autofocus class="form-control" autocomplete="given-name" oninput="validateInput(this)">
                <input type="text" name="lname" id="lname" placeholder="Last name/الاسم الأخير" required class="form-control" autocomplete="family-name" oninput="validateInput(this)">
                <input type="text" name="father_name" id="father_name" placeholder="Father name/اسم الأب" required class="form-control" oninput="validateInput(this)">
                <input type="text" name="mother_name" id="mother_name" placeholder="Mother name/اسم الأم" required class="form-control" oninput="validateInput(this)">
                <input type="email" name="email" id="email" placeholder="Email/البريد الإلكتروني" required class="form-control" autocomplete="email">
                <input type="text" name="password" id="password" placeholder="Password/كلمة السر" required class="form-control" oninput="validateInput(this)" oninput="validateInput(this)">
                <input type="text" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password/تأكيد كلمة السر" required class="form-control" oninput="validateInput(this)">
                <input type="tel" name="telephone" id="telephone" placeholder="phone number/رقم الهاتف" required class="form-control" autocomplete="tel" oninput="validateInput(this)">
                <input type="text" name="national_number" id="national_number" placeholder="National number/الرقم الوطني" required class="form-control" oninput="validateInput(this)">
                <input list="city" name="location" id="location" required placeholder="city/المدينة" class="form-control">
                <datalist id="city">
                    <option value="Damascus">Damascus</option>
                    <option value="Homs">Homs</option>
                    <option value="Aleppo">Aleppo</option>
                    <option value="Latakia">Latakia</option>
                    <option value="Daraa">Daraa</option>
                    <option value="Der alzor">Der alzor</option>
                    <option value="Hama">Hama</option>
                    <option value="Tartus">Tartus</option>
                    <option value="Raqqa">Raqqa</option>
                    <option value="Idlib">Idlib</option>
                    <option value="Alswayda">Alswayda</option>
                    <option value="Alhasakah">Alhasakah</option>
                    <option value="Alqamishli">Alqamishli</option>
                </datalist>
                
                <input list="course_place_list" name="course_place" id="course_place" required placeholder="course place/مكان الدورة" class="form-control">
                <datalist id="course_place_list">
                    <option value="Damascus">Damascus</option>
                    <option value="Deir Attieh">Deir Attieh</option>
                    <option value="Homs">Homs</option>
                </datalist>
                
               
        
                <select name="course_name" id="course_name" class="form-control" required>
    <option value="" disabled selected>Select course/اسم الدورة</option>
    @foreach($courses as $course)
        <option value="{{ $course->name }}">
            {{ ucfirst($course->name) }} 
        </option>
    @endforeach
</select>


                <!--<h2><strong>When do you want to start the course?</strong></h2>-->
                <h2 align="right"><strong>اختر الوقت الذي يناسبك للبدء بالدورة </strong></h2>
                <div class="form-group-row">
                <div class="form-group">
                    <label for="course_time_hour">Hour/الساعة</label>
                    <div class="datetime-container">
                        <select id="course_time_hour" name="course_time_hour" class="time-picker form-control">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="course_time_minute">Minute/الدقيقة</label>
                    <div class="datetime-container">
                        <select id="course_time_minute" name="course_time_minute" class="time-picker form-control">
                            @for ($i = 0; $i < 60; $i += 15)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                </div>
                <div class="form-group-row">
                <div class="form-group">
                    <label for="course_time_ampm">AM/PM(صباحاً/مساءً)</label>
                    <div class="datetime-container">
                        <select id="course_time_ampm" name="course_time_ampm" class="am-pm-picker form-control">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="course_time_day_month_year">Date/التاريخ</label>
                    <input type="text" id="course_time_day_month_year" name="course_time_day_month_year" class="form-control date-picker" placeholder="DD-MM-YYYY" required>
                </div>
                </div>
                <div class="form-group">
                    <label for="user_image">Trainee image/صورة المتدرب</label>
                    <input type="file" name="user_image" id="user_image" required class="form-control">
                    @error('user_image')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if ($errors->has('error'))
                        <div class="error-message" style="color: red;">
                            <strong>{{ $errors->first('error') }}</strong>
                        </div>
                    @endif
                </div>

                <input type="hidden" name="qr_code_path" id="qr_code_path">
                <input type="submit" value="Register" class="form-control2">
            </form>
        </div>
    </div>

     <!-- Include jQuery and jQuery UI -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>

    <!-- Custom JS -->

<head>
    <!-- Include jQuery and jQuery UI -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Include jQuery UI CSS for styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
</head>
<body>
    <!-- Your HTML content -->

   
     <!-- Include jQuery and jQuery UI -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>

<!-- Custom JS -->
<script>
     // Scroll to top on page load
     window.onload = function() {
        window.scrollTo(0, 0);
    };

    $(document).ready(function () {
        // Scroll to top when document is ready (after refresh)
        window.scrollTo(0, 0);
        $('.date-picker').datepicker({
            dateFormat: 'dd-mm-yy'
        });

        // Function to handle form submission
        $('#registration-form').on('submit', function (e) {
            // Prevent default form submission
            e.preventDefault();

            var form = this;

            var qrCodeText = form.email.value; // Use email for QR code generation

            // Generate QR code
            QRCode.toDataURL(qrCodeText, function (err, url) {
                if (err) {
                    console.error(err);
                    alert('Error generating QR code. Please try again.');
                } else {
                    // Set the generated QR code data URL in the hidden input field
                    document.getElementById('qr_code_path').value = url;

                    // Now submit the form
                    form.submit();
                }
            });
        });
    });

    // Function to validate input to allow only English characters
          function validateInput(input) {
            input.value = input.value.replace(/[^a-zA-Z0-9\s]/g, '');
        }
           
</script>


</body>
</html>
