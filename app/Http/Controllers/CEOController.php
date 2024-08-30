<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Ceo;
use App\Models\Course2;
use App\Models\Profile3;
use App\Models\Teacher;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class CEOController extends Controller
{
    public function __construct()
    {
        // Middleware to ensure only authenticated CEO can access certain methods
        $this->middleware('auth:ceo')->except(['showLoginForm', 'login']);
    }

    public function showLoginForm()
    {
        return view('ceo.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('ceo')->attempt($credentials)) {
            return redirect()->route('ceo.profile');
        }

        Log::warning('Login attempt failed for email: ' . $request->email);
        return redirect()->back()->withErrors(['error' => 'Email or password is incorrect']);
    }

    public function profile()
    {
        if (!Auth::guard('ceo')->check()) {
            return redirect()->route('ceo.login');
        }

        $ceo = Auth::guard('ceo')->user();
        $students = User::with(['profile3.course2'])->get(); // Fetch all students with related profiles and courses

        return view('ceo.profile', compact('ceo', 'students'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function show($userId)
    {
        $user = User::findOrFail($userId);
        $profile3 = Profile3::where('user_id', $userId)->first();

        return view('ceo.show', compact('user', 'profile3'));
    }

    public function getProfilesByCourse($courseId)
    {
        $profiles = Profile3::where('course22_id', $courseId)->with('user', 'course2')->get();
        return response()->json($profiles);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('fname', 'like', "%{$search}%")
                             ->orWhere('lname', 'like', "%{$search}%")
                             ->orWhere('username', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('telephone', 'like', "%{$search}%")
                             ->orWhere('location', 'like', "%{$search}%")
                             ->orWhereHas('profile3', function ($query) use ($search) {
                                 $query->where('course_place', 'like', "%{$search}%")
                                       ->orWhereHas('course2', function ($query) use ($search) {
                                           $query->where('name', 'like', "%{$search}%");
                                       });
                             });
            })
            ->get();

        return view('ceo.profile', compact('users'));
    }

    public function downloadQrCode(User $user)
    {
        if (!$user->profile3 || !$user->profile3->qr_code_path) {
            return redirect()->back()->withErrors('QR code not found for this user.');
        }

        $filePath = 'storage/qrcodes/' . basename($user->profile3->qr_code_path);
        $fullPath = public_path($filePath);

        if (!file_exists($fullPath)) {
            return redirect()->back()->withErrors('QR code file does not exist.');
        }

        return response()->download($fullPath);
    }

    public function createTeacher()
    {
        $teachers = Teacher::all();
        return view('ceo.add_teacher', compact('teachers'));
    }

    public function storeTeacher(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|string|min:8',
        ]);

        // Create the teacher
        $teacher = Teacher::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Generate QR code
        $qrCodeText = $request->email;
        $qrCode = new QrCode($qrCodeText);
        $writer = new PngWriter();
        $qrCodePath = 'qrcodes/' . uniqid() . '.png';
        $qrCodeAbsolutePath = storage_path('app/public/' . $qrCodePath);
        $writer->writeFile($qrCode, $qrCodeAbsolutePath);

        // Save QR code path to the teacher
        $teacher->qr_code_path = $qrCodePath;
        $teacher->save();

        Log::info('QR code generated at: ' . $qrCodePath);

        return redirect()->route('ceo.teachers.create')->with('success', 'Teacher added successfully.');
    }

    public function showQrCode($id)
    {
        $teacher = Teacher::findOrFail($id);

        if (!$teacher->qr_code_path) {
            return redirect()->back()->withErrors('QR code not found for this teacher.');
        }

        return view('ceo.teachers.qrcode', compact('teacher'));
    }

    public function destroyTeacher(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('ceo.teachers.create')->with('success', 'Teacher removed successfully.');
    }
}
