<!-- certificate_date1.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Additional Course Dates</title>
</head>
<body>
    <h1>Enter Additional Course Dates</h1>
    <form action="{{ route('admin.users.storeAdditionalCourseCertificate', ['user' => $user->id, 'courseProfile3' => $courseProfile3->id]) }}" method="POST">
    @csrf
    <label for="start_date1">Start Date:</label>
        <input type="date" id="start_date1" name="start_date1" required>
        <br>
        <label for="end_date1">End Date:</label>
        <input type="date" id="end_date1" name="end_date1" required>
        <br>
        <label for="awarding1">Awarding Date:</label>
        <input type="date" id="awarding1" name="awarding1" required>
        <br>
        <button type="submit">Submit</button>
</form>

</body>
</html>
