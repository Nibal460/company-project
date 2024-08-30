<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Manager Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            display: block;
            margin: 0 auto 10px;
            max-width: 200px;
            width: 100%;
            height: auto;
        }
        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 150px;
            margin: 0 auto 20px;
            padding: 10px;
            background-color: rgb(57, 190, 239);
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
        }
        .logout-btn i {
            margin-left: 8px;
        }
        .logout-btn:hover {
            background-color: rgb(47, 170, 219);
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
        .custom-search-input {
            width: 50%;
        }
        .custom-search-input .input-group {
            height: 50px;
        }
        .custom-search-input .form-control {
            height: 100%;
        }
        .custom-search-input .btn-outline-secondary {
            background-color: rgb(57, 190, 239);
            color: white;
            border: none;
            height: 100%;
        }
        .custom-search-input .btn-outline-secondary:hover {
            background-color: rgb(47, 170, 219);
        }
        @media (max-width: 768px) {
            .custom-search-input {
                width: 100%;
            }
        }
        .button-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ asset('images/techturn-logo.png') }}" alt="Logo" class="logo">
        <!-- Logout Button -->
        <a href="{{ route('manager.logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout <i class="fas fa-sign-out-alt"></i>
        </a>
        <h1>
        Hello 
        @if(strtolower($manager->gender) == 'male') 
            Mr. 
        @else 
            Miss. 
        @endif 
        {{ $manager->first_name }}
        </h1>
        
        <p><strong>First Name:</strong> {{ $manager->first_name }}</p>
        <p><strong>Last Name:</strong> {{ $manager->last_name }}</p>
        <p><strong>Email:</strong> {{ $manager->email }}</p>
        <p><strong>Gender:</strong> {{ $manager->gender }}</p>
        @if($manager->qr_code_path)
            <p><strong>QR Code:</strong></p>
            <img src="{{ asset('storage/' . $manager->qr_code_path) }}" alt="QR Code">
        @endif

        <form id="logout-form" action="{{ route('manager.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <!-- Search Box -->
        <div class="custom-search-input">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Search students...">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="searchStudents()">Search</button>
                </div>
            </div>
        </div>

        <h2>Students</h2>
        <table id="students-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Course Place</th>
                    <th>Course Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="students-list">
                @foreach($students as $student)
                    <tr>
                        <td data-label="ID">{{ $student->id }}</td>
                        <td data-label="First Name">{{ $student->fname }}</td>
                        <td data-label="Last Name">{{ $student->lname }}</td>
                        <td data-label="Email">{{ $student->email }}</td>
                        <td data-label="Course Place">{{ $student->profile3->course_place ?? 'N/A' }}</td>
                        <td data-label="Course Name">{{ $student->profile3->course2->name ?? 'N/A' }}</td>
                        <td data-label="Actions">
                            <a href="{{ route('manager.users.show', $student->id) }}" class="btn btn-sm btn-secondary">Show</a>
                            <button onclick="removeStudent({{ $student->id }})" class="btn btn-sm btn-danger">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
    function searchStudents() {
        var searchQuery = $('#search').val().toLowerCase();
        $('#students-list tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchQuery) > -1)
        });
    }

    function removeStudent(studentId) {
        if (confirm('Are you sure you want to remove this student?')) {
            $.ajax({
                url: '/manager/users/' + studentId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    location.reload();
                },
                error: function(err) {
                    alert('Error removing student. Please try again.');
                }
            });
        }
    }
    </script>
</body>
</html>
