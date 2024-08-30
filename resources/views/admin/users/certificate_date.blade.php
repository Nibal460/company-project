<!-- certificate_date.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Course Dates</title>
</head>
<body>
    <h1>Enter Course Dates</h1>
    <form action="{{ route('admin.users.storeCourseTimes', ['user' => $user->id, 'course2' => $course2->id]) }}" method="POST">
        @csrf
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>
        <br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
        <br>
        <label for="awarding">Awarding Date:</label>
        <input type="date" id="awarding" name="awarding" required>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
