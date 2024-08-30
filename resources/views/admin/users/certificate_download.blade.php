<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        /* Add your CSS styles here for the downloadable certificate */
    </style>
</head>
<body>
    <div class="container">
        <h1>Certificate</h1>
        <p>This is to certify that <strong>{{ $user->fname }} {{ $user->lname }}</strong> has successfully completed the course <strong>{{ $course->name }}</strong>.</p>
        <p><strong>Course Duration:</strong> {{ $startDate }} to {{ $endDate }}</p>
    </div>
</body>
</html>
