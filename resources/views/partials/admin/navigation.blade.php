<nav>
    <ul>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('admin.profile.show', Auth::user()) }}">My Profile</a></li>
        <!-- Add a link to view other user profiles (if desired) -->
        <!-- <li><a href="{{ route('admin.users.index') }}">Manage Users</a></li> -->
    </ul>
</nav>
