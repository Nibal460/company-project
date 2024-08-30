<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* Custom CSS variable */
        :root {
            --maincolor: rgb(57, 190, 239);
        }

        /* Basic styling */
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
            border: 2px solid var(--maincolor);
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 50%; /* Reduce the logo size by 50% */
            height: auto;
        }
        h1 {
            text-align: center;
        }
        form {
            margin-top: 30px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="email"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: var(--maincolor);
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #4caf50;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 15px;
            }
            h1 {
                font-size: 1.5rem;
            }
            input[type="email"],
            input[type="password"] {
                padding: 8px;
            }
            input[type="submit"] {
                padding: 10px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .container {
                margin: 10px;
                padding: 10px;
            }
            h1 {
                font-size: 1.25rem;
            }
            input[type="email"],
            input[type="password"] {
                padding: 6px;
            }
            input[type="submit"] {
                padding: 8px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <img class="logo" src="{{ asset('images/company-logo22.png') }}" alt="Logo">
    <h1>Reset Password</h1>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $email) }}" required autofocus>

        <label for="password">New Password:</label>
        <input type="text" id="password" name="password" required>

        <label for="password-confirm">Confirm Password:</label>
        <input type="text" id="password-confirm" name="password_confirmation" required>

        <input type="submit" value="Reset Password">
    </form>
</div>

</body>
</html>
