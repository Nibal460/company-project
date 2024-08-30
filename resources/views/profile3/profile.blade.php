<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/Techturn-logo.png') }}">
    <title>Profile</title>
<!-- resources/views/profile.blade.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile3.show') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" id="fname" name="fname" value="{{ auth()->user()->fname }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" id="lname" name="lname" value="{{ auth()->user()->lname }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone:</label>
                            <input type="telephone" id="telephone" name="telephone" value="{{ auth()->user()->telephone }}" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <select name="location" id="location" class="form-control">
                                <option value="">Select Location</option>
                                <option value="Aleppo" @if(isset($profile3) && $profile3->location == 'Aleppo') selected @endif>حلب</option>
                                
                                <optgroup label="English">
            <option value="Aleppo" @if(isset($user) && $user->location == 'Aleppo') selected @endif>Aleppo</option>
            <option value="Damascus" @if(isset($user) && $user->location == 'Damascus') selected @endif>Damascus</option>
            <option value="Homs" @if(isset($user) && $user->location == 'Homs') selected @endif>Homs</option>
            <option value="Hama" @if(isset($user) && $user->location == 'Hama') selected @endif>Hama</option>
            <option value="Latakia" @if(isset($user) && $user->location == 'Latakia') selected @endif>Latakia</option>
            <option value="Tartus" @if(isset($user) && $user->location == 'Tartus') selected @endif>Tartus</option>
            <option value="Raqqa" @if(isset($user) && $user->location == 'Raqqa') selected @endif>Raqqa</option>
            <option value="Deir ez-Zor" @if(isset($user) && $user->location == 'Deir ez-Zor') selected @endif>Deir ez-Zor</option>
            <option value="Idlib" @if(isset($user) && $user->location == 'Idlib') selected @endif>Idlib</option>
            <option value="Daraa" @if(isset($user) && $user->location == 'Daraa') selected @endif>Daraa</option>
            <option value="As-Suwayda" @if(isset($user) && $user->location == 'As-Suwayda') selected @endif>As-Suwayda</option>
            <option value="Al-Hasakah" @if(isset($user) && $user->location == 'Al-Hasakah') selected @endif>Al-Hasakah</option>
            <option value="Qamishli" @if(isset($user) && $user->location == 'Qamishli') selected @endif>Qamishli</option>
            <option value="Salamiyah" @if(isset($user) && $user->location == 'Salamiyah') selected @endif>Salamiyah</option>
        </optgroup>
        <optgroup label="Arabic">
            <option value="حلب" @if(isset($user) && $user->location == 'حلب') selected @endif>حلب</option>
            <option value="دمشق" @if(isset($user) && $user->location == 'دمشق') selected @endif>دمشق</option>
            <option value="حمص" @if(isset($user) && $user->location == 'حمص') selected @endif>حمص</option>
            <option value="حماة" @if(isset($user) && $user->location == 'حماة') selected @endif>حماة</option>
            <option value="اللاذقية" @if(isset($user) && $user->location == 'اللاذقية') selected @endif>اللاذقية</option>
            <option value="طرطوس" @if(isset($user) && $user->location == 'طرطوس') selected @endif>طرطوس</option>
            <option value="الرقة" @if(isset($user) && $user->location == 'الرقة') selected @endif>الرقة</option>
            <option value="دير الزور" @if(isset($user) && $user->location == 'دير الزور') selected @endif>دير الزور</option>
            <option value="إدلب" @if(isset($user) && $user->location == 'إدلب') selected @endif>إدلب</option>
            <option value="درعا" @if(isset($user) && $user->location == 'درعا') selected @endif>درعا</option>
            <option value="السويداء" @if(isset($user) && $user->location == 'السويداء') selected @endif>السويداء</option>
            <option value="الحسكة" @if(isset($user) && $user->location == 'الحسكة') selected @endif>الحسكة</option>
            <option value="القامشلي" @if(isset($user) && $user->location == 'القامشلي') selected @endif>القامشلي</option>
            <option value="سلمية" @if(isset($user) && $user->location == 'سلمية') selected @endif>سلمية</option>
        </optgroup>
    </select>
</div>











                        </div>

                        <!-- Add other profile fields here -->

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">Save Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
