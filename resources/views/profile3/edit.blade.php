<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <img class="logo" src="{{ asset('images/Techturn-logo.png') }}" alt="Logo">
                <div class="card-header">Edit Profile</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile3.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" id="fname" name="fname" value="{{ $user->fname }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" id="lname" name="lname" value="{{ $user->lname }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="father_name">Father Name:</label>
                            <input type="text" id="father_name" name="father_name" value="{{ $profile3->father_name }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="mother_name">Mother Name:</label>
                            <input type="text" id="mother_name" name="mother_name" value="{{ $profile3->mother_name }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" id="email" name="email" value="{{ $user->email }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="telephone">Telephone Number:</label>
                            <input type="text" id="telephone" name="telephone" value="{{ $user->telephone }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="national_number">National Number:</label>
                            <input type="text" id="national_number" name="national_number" value="{{ $profile3->national_number }}" class="form-control">
                        </div>

                   <div class="form-group">
                        <label for="location">Location:</label>
                        <select name="location" id="location" class="form-control">
                            @php
                                $cities = ['Damascus', 'Homs', 'Aleppo', 'Latakia', 'Daraa', 'Der alzor', 'Hama', 'Tartus', 'Raqqa', 'Idlib', 'Alswayda', 'Alhasakah', 'Alqamishli'];
                                $userLocation = $user->location;
                                if (($key = array_search($userLocation, $cities)) !== false) {
                                    unset($cities[$key]);
                                }
                                array_unshift($cities, $userLocation);
                            @endphp

                            @foreach($cities as $city)
                                <option value="{{ $city }}" @if($userLocation == $city) selected @endif>{{ $city }}</option>
                            @endforeach
                        </select>
                    </div>

                    

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="{{ route('profile3.show') }}" class="btn btn-secondary cancel-link">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
