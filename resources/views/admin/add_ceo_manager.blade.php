<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Add CEO Manager</title>

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
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
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




<div class="container">
    <h2>Add CEO Manager</h2>
    <form action="{{ route('admin.ceo_managers.store') }}" method="POST">
        @csrf
        <!-- Form fields for CEO manager details -->
        <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" class="form-control" required>
            </div>
            <!-- Button group -->
            <div class="btn-group">
             <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Add CEO Manager</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to Admin</a>
            </div>
        </form>

        <!-- Managers Table -->
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
                @foreach($ceos as $ceo)
                    <tr>
                        <!-- Manager information -->
                        <td>{{ $ceo->first_name }}</td>
                        <td>{{ $ceo->last_name }}</td>
                        <td>{{ $ceo->gender }}</td>
                        <td>{{ $ceo->email }}</td>
                        <!-- Actions buttons -->
                        <td>
                        @if ($ceo->qr_code_path)
                    <a href="{{ route('admin.ceos.qrcode', $ceo->id) }}" class="btn btn-info" target="_blank">View QR Code</a>
                     @else
                        N/A
                    @endif


   
                       </td>
                        <td>
                            <!-- Modify or delete as needed -->
                            <form action="{{ route('admin.ceo_managers.destroy', $ceo->id) }}" method="POST" style="display:inline;">
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

