<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/company-logo-removebg-preview.png') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    
    <meta charset="UTF-8">
    <title>Admin Login Not Right</title>
</head>

<body>
<div>
        <img src="{{ asset('images/company-logo-removebg-preview.png') }}" alt="Company Logo">
    <form method="POST" action="{{ route('login') }}">>
        @csrf   
        <input type="text" name="username_or_email" autofocus placeholder="Username or Email" required />
            <header>
                <input id="password" type="password" name="password" placeholder="Password" class="password" required />
                <button type="button" id="togglePassword"><i id="show" class="fa-solid fa-eye"></i></button>
            </header>
            <input type="submit" value="Log in">
           
        </form>

        <nav>
            <a href="https://www.facebook.com/TechTurn.co" target="_blank"><i class="fab fa-facebook face"></i></a>
            <a href="tel:+963994022348"><i class="fab fa-whatsapp whats"></i></a>
            <a href="tel:+963994022348"><i class="fab fa-telegram tele"></i></a>
        </nav>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            var password = document.getElementById('password');
            var icon = document.getElementById('show');
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>
