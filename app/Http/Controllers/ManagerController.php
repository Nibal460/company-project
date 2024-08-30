<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Manager;
use App\Models\User;
use App\Models\Course2;
use App\Models\Profile3;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:manager')->except(['showLoginForm', 'login']);
    }

    public function showLoginForm()
    {
        return view('manager.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('manager')->attempt($credentials)) {
            return $this->authenticated($request, Auth::guard('manager')->user());
        }

        Log::warning('Login attempt failed for email: ' . $request->email);
        return redirect()->back()->withErrors(['error' => 'Email or password is incorrect']);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('manager.profile');
    }

    public function profile()
    {
        if (!Auth::guard('manager')->check()) {
            return redirect()->route('manager.login');
        }

        $manager = Auth::guard('manager')->user();
        $students = User::with(['profile3.course2'])->get(); // Fetch all students with related profiles and courses

        return view('manager.profile', compact('manager', 'students'));
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

        return view('manager.show', compact('user', 'profile3'));
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

        return view('manager.profile', compact('users'));
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
        return view('manager.add_teacher', compact('teachers'));
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
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodePath = 'qrcodes/' . uniqid() . '.svg';
        $qrCodeAbsolutePath = storage_path('app/public/' . $qrCodePath);

        $writer->writeFile($qrCodeText, $qrCodeAbsolutePath);

        // Save QR code path to the teacher
        $teacher->qr_code_path = $qrCodePath;
        $teacher->save();

        Log::info('QR code generated at: ' . $qrCodePath);

        return redirect()->route('manager.teachers.create')->with('success', 'Teacher added successfully.');
    }

    public function showQrCode($id)
    {
        $teacher = Teacher::findOrFail($id);

        if (!$teacher->qr_code_path) {
            return redirect()->back()->withErrors('QR code not found for this teacher.');
        }

        return view('manager.teachers.qrcode', compact('teacher'));
    }

    public function destroyTeacher(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('manager.teachers.create')->with('success', 'Teacher removed successfully.');
    }
}
