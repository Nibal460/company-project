<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/company-logo-removebg-preview.png">
    <title>TechTurn</title>
    
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <div class="top-bar">
        @if(auth()->check())
        <div class="user-panel">
            <div class="profile-icon">
                <!-- Icon for profile -->
                <a href="{{ route('profile2.show') }}">
                    <i class="fa fa-user"></i>
                    <b>Profile</b>
                </a>
            </div>
            <div class="logout-icon">
                <!-- Icon for logout -->
                <a href="#" class="logout-link">
                    <i class="fa fa-sign-out"></i>
                    <b>Logout</b>
                </a><
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        @endif
    </div>

    <div class="welcome-message">
        Welcome to Tech Turn Company!
    </div>

    <script>
        document.querySelector('.logout-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            
            // Submit the logout form
            document.getElementById('logout-form').submit();
        });
    </script>
</body>
</html>
