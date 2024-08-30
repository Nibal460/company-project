<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
            background-color: #f9f9f9; /* Background color for the page */
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: var(--maincolor); /* Use the custom color variable for heading */
            text-align: center;
        }
        /* Form styles */
        form {
            margin-top: 30px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: var(--maincolor); /* Use the custom color variable for button */
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #4caf50; /* Darker color on hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Reset Password23</h1>
    <form action="{{ route('password.reset') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <input type="submit" value="Reset Password">
    </form>
</div>

</body>
</html>
