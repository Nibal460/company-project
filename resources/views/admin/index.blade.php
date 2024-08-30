<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - All Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            th, td {
                text-align: right;
                position: relative;
                padding-left: 50%;
            }
            th::before, td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 45%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">All Users</h1>
        
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-4">Add New Course</a>

        @if ($users->isEmpty())
            <p>No users found.</p>
        @else
            <table class="table table-responsive-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Course Place</th>
                        <th>Course ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td data-label="ID">{{ $user->id }}</td>
                            <td data-label="First Name">{{ $user->fname }}</td>
                            <td data-label="Last Name">{{ $user->lname }}</td>
                            <td data-label="Email">{{ $user->email }}</td>
                            <td data-label="Course Place">{{ $user->profile3->course_place }}</td>
                            <td data-label="Course2 ID">{{ $user->profile3->course2_id }}</td>
                            <td data-label="Actions">
                                <a href="{{ route('admin.download-qrcode', $user->id) }}" class="btn btn-sm btn-secondary">Download QR Code</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
