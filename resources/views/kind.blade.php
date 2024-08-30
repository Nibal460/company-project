<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('images/company-logo22.png') }}">
    <title>Accounts</title>
    <link rel="stylesheet" href="css/kind.css">
    <style>
        body {
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        height: 100vh; /* Ensures the background covers the entire viewport height */
        background-image:url(../images/back-5.png);
        overflow: hidden; /* Prevent scrolling */
    }

        .container {
            text-align: center;
            padding: 20px;
            font-family: 'Lora', serif;
        }
        .logo img {
            max-width: 300px;
            margin-bottom: 20px;
        }
        .links {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .link-box {
            display: block;
            width: 100%;
            max-width: 200px;
            padding: 10px 20px;
            margin: 10px 0;
            font-size: 16px;
            text-align: center;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .link-box:hover {
            background-color: #0056b3;
        }
        

    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="images/company-logo22.png" alt="Company Logo">
        </div>
        <div class="links">
            <a href="{{ route('admin.login') }}" class="link-box">Admin/الأدمن</a>
            <a href="{{ route('teacher.login') }}" class="link-box">Trainer/المدرب</a>
            <a href="{{ route('login') }}" class="link-box">Trainee/المتدرب</a>
            <a href="{{ route('manager.login') }}" class="link-box">Manager/المدير</a>
            <a href="{{ route('ceo.login') }}" class="link-box">CEO/المدير التنفيذي</a>
        </div>
    </div>
  
</body>
</html>
