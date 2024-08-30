<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Admin - All Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --maincolor: rgb(57, 190, 239);
        }
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
            max-width: 230px;
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
            margin: 20px auto;
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

        .button-group2 {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            width: 100%;
            margin: 20px 0;
        }

        .btn2 {
            flex: 1 1 calc(25% - 20px);
            max-width: calc(25% - 20px);
            padding: 10px;
            background-color: var(--maincolor);
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            box-sizing: border-box;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            .btn2 {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Logo -->
    <img class="logo" src="{{ asset('images/techturn-logo.png') }}" alt="Logo">

    <!-- Logout Button -->
    <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-decoration: none;">
        Logout <i class="fas fa-sign-out-alt"></i>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <h1 class="mb-4">All Trainees</h1>
    <div class="button-group2">
        <a href="{{ route('admin.courses.create') }}" class="btn2" style="text-decoration: none;">Add New Course</a>
        <a href="{{ route('admin.teachers.create') }}" class="btn2" style="text-decoration: none;">Add New Trainer</a>
        <a href="{{ route('admin.managers.create') }}" class="btn2" style="text-decoration: none;">Add Normal Manager</a>
        <a href="{{ route('admin.ceo_managers.create') }}" class="btn2" style="text-decoration: none;">Add CEO Manager</a>
    </div>

    <div class="custom-search-input">
        <div class="input-group">
            <input type="text" id="searchBox" class="form-control" placeholder="Search by any field">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">Clear</button>
            </div>
        </div>
    </div>

    @if ($users->isEmpty())
        <p>No Trainees found</p>
    @else
        <table class="table table-responsive-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Course Place</th>
                    <th>Course Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach ($users as $user)
                    <tr>
                        <td data-label="ID">{{ $user->id }}</td>
                        <td data-label="First Name">{{ $user->fname }}</td>
                        <td data-label="Last Name">{{ $user->lname }}</td>
                        <td data-label="Email">{{ $user->email }}</td>
                        <td data-label="Location">{{ $user->location }}</td>
                        <td data-label="Course Place">{{ optional($user->profile3)->course_place }}</td>
                        <td data-label="Course Name">{{ $user->course2->name ?? 'N/A' }}</td>
                        <td data-label="Actions">
                            <a href="{{ route('admin.users.show', ['user' => $user->id]) }}" class="btn btn-sm btn-secondary">Show</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <form action="{{ route('admin.users.index') }}" method="GET">
        <div>
            <label for="course_place">Course Place:</label>
            <select name="course_place" id="course_place">
                <option value="">Select a place</option>
                <option value="Damascus">Damascus</option>
                <option value="Homs">Homs</option>
                <option value="Deir Attieh">Deir Attieh</option>
            </select>
        </div>

        <div>
            <label>Course Name:</label>
            @php
                $uniqueCourseNames = $courses->pluck('name')->map(function($name) {
                    return strtolower($name);
                })->unique();
            @endphp
            @foreach($uniqueCourseNames as $courseName)
                <div>
                    <input type="radio" id="course_name_{{ $courseName }}" name="course_name" value="{{ $courseName }}" onchange="filterDescriptions()">
                    <label for="course_name_{{ $courseName }}">{{ ucwords($courseName) }}</label>
                </div>
            @endforeach
        </div>

        <div>
            <label for="description">Course Number:</label>
            <select name="description" id="description">
                <!-- Descriptions will be populated dynamically based on the selected course -->
            </select>
        </div>

        <button type="submit">Search</button>
    </form>

    @if(isset($filteredUsers) && $filteredUsers->isNotEmpty())
        <table class="table table-responsive-sm mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Course Place</th>
                    <th>Course Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($filteredUsers as $user)
                    <tr>
                        <td data-label="ID">{{ $user->id }}</td>
                        <td data-label="First Name">{{ $user->fname }}</td>
                        <td data-label="Last Name">{{ $user->lname }}</td>
                        <td data-label="Email">{{ $user->email }}</td>
                        <td data-label="Location">{{ $user->location }}</td>
                        <td data-label="Course Place">{{ optional($user->profile3)->course_place }}</td>
                        <td data-label="Course Name">{{ $user->course2->name ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p></p>
    @endif
</div>

<script>
    const courses = @json($courses);
    const descriptions = @json($descriptions);

    function filterDescriptions() {
        const selectedCourseName = document.querySelector('input[name="course_name"]:checked').value;
        const descriptionSelect = document.getElementById('description');
        descriptionSelect.innerHTML = '';

        const filteredDescriptions = descriptions.filter(desc => desc.name.toLowerCase() === selectedCourseName);
        filteredDescriptions.forEach(desc => {
            const option = document.createElement('option');
            option.value = desc.description;
            option.text = desc.description;
            descriptionSelect.appendChild(option);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        const courseRadios = document.querySelectorAll('input[name="course_name"]');
        courseRadios.forEach(radio => {
            radio.addEventListener('change', filterDescriptions);
        });

        if (courseRadios.length > 0) {
            const selectedCourseRadio = document.querySelector('input[name="course_name"]:checked');
            if (selectedCourseRadio) {
                selectedCourseRadio.dispatchEvent(new Event('change'));
            }
        }

        const searchBox = document.getElementById('searchBox');
        searchBox.addEventListener('input', function () {
            const searchTerm = searchBox.value.toLowerCase();
            const tableRows = document.querySelectorAll('#userTableBody tr');

            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let match = false;
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchTerm)) {
                        match = true;
                    }
                });
                row.style.display = match ? '' : 'none';
            });
        });
    });

    function clearSearch() {
        document.getElementById('searchBox').value = '';
        const tableRows = document.querySelectorAll('#userTableBody tr');
        tableRows.forEach(row => {
            row.style.display = '';
        });
    }
</script>
</body>
</html>