<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Teacher;
use App\Models\Course2;
use App\Models\User;

class TeacherController extends Controller
{
    public function showLoginForm()
    {
        return view('teacher.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('teacher')->attempt($credentials)) {
            return redirect()->intended(route('teacher.profile'));
        }

        Log::warning('Login attempt failed for email: ' . $request->email);
        return redirect()->back()->withErrors(['error' => 'Email or password is incorrect']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function profile()
    {
        $teacher = Auth::guard('teacher')->user();
        $courses = Course2::all(); // Assuming you have a Course model
        return view('teacher.profile', compact('teacher', 'courses'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('teacher.show', compact('user'));
    }

    public function getStudents($course22_id)
    {
        $course = Course2::findOrFail($course22_id);
        $profile3s = $course->profile3s;
        return response()->json($profile3s);
    }
}
