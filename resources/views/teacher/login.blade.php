<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Trainer Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div>
        <img src="{{ asset('images/company-logo22.png') }}" alt="Company Logo">
        <form method="POST" action="{{ route('teacher.login.submit') }}">
    @csrf
    <input type="text" name="email" value="{{ old('email') }}" autofocus placeholder="Email" required />
    <header class="password-container">
        <input id="password" type="password" name="password" placeholder="Password" class="password" required />
        <button type="button" id="togglePassword"><i id="show" class="fa-solid fa-eye"></i></button>
    </header>
    <input type="submit" value="Log in">
    
    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</form>


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
