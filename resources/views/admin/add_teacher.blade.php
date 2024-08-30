<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Add Trainer</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .container {
            max-width: 680px; 
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
        input[type="email"],
        input[type="text"],
        select {
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
        .btn-secondary {
            margin-left: 10px;
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
        /* Modified button style */
        .btn-info {
            padding: 5px 15px; /* Adjust padding to change button size */
            font-size: 14px; /* Adjust font size if needed */
        }

        /* Responsive adjustments */
        @media only screen and (max-width: 768px) {
            .container {
                padding: 10px;
            }
            .btn {
                padding: 8px 16px;
                font-size: 14px;
            }
            .btn-info {
                padding: 4px 12px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Trainer</h1>
        <!-- Form to add a new teacher -->
        <form method="POST" action="{{ route('admin.teachers.store') }}">
            @csrf
            <!-- First Name input -->
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
                @error('first_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Last Name input -->
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
                @error('last_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Gender select -->
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                @error('gender')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Email input -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Password input -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" class="form-control" required>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Button group -->
            <div class="btn-group">
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Add Trainer</button>
                <!-- Back button -->
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to Admin</a>
            </div>
        </form>

        <!-- Teachers Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>QR Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <!-- Teacher information -->
                        <td>{{ $teacher->first_name }}</td>
                        <td>{{ $teacher->last_name }}</td>
                        <td>{{ $teacher->gender }}</td>
                        <td>{{ $teacher->email }}</td>
                        <!-- View QR Code button -->
                        <td>
                        

                            @if ($teacher->qr_code_path)
                            <a href="{{ route('admin.teachers.qrcode', $teacher->id) }}" class="btn btn-info" target="_blank">View QR Code</a>
                        @else
                            N/A
                        @endif
                            
                        </td>
                        <!-- Remove button -->
                        <td>
                            <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
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
