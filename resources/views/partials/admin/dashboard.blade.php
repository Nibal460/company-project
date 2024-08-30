@extends('admin.layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>

    <!-- Your dashboard content -->

    <p><a href="{{ route('admin.profile.show', Auth::user()) }}">View My Profile</a></p>
    <p>Welcome, Admin!</p>
<p>Your email: {{ $adminEmail }}</p>
@endsection
