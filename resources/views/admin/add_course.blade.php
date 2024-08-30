<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Add Course</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            box-shadow: 0 4px #999;
        }
        .btn-primary:hover {
            background-color: #0069d9;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn-group {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .btn-secondary {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Course</h1>
        <!-- Add Course Form -->
        <form method="POST" action="{{ route('admin.courses.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Course Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="hours">Course Hours:</label>
                <input type="number" id="hours" name="hours" class="form-control" required>
                @error('hours')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Add Course button -->
            <button type="submit" class="btn btn-primary">Add Course</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to Admin</a>
        </form>

        <!-- Courses Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Course Hours</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->hours }}</td>
                        <td>{{ $course->description }}</td>
                        <td>
                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Remove</button>
                        </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
