<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Course2;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;
use Intervention\Image\Facades\Image;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    
    public function login(Request $request)
    {
        $request->validate([
            'username_or_email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('password');
        $field = filter_var($request->username_or_email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $request->username_or_email, 'password' => $request->password])) {
            return $this->authenticated($request, Auth::user());
        }

        Log::warning('Login attempt failed for username/email: ' . $request->username_or_email);
        return redirect()->back()->withErrors(['error' => 'username/email or password is incorrect']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect('/home');
    }

    public function register(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'telephone' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'course_place' => 'required|string|max:255',
            'course_name' => 'required|string',
            'user_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:700',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'national_number' => 'required|string|max:255|unique:profile3s,national_number|unique:users,email',
            'course_time_hour' => 'required|string',
            'course_time_minute' => 'required|string',
            'course_time_ampm' => 'required|string',
            'course_time_day_month_year' => 'required|date_format:d-m-Y',
        ]);
    
        try {
            // Find the course with the highest description for the selected course name
            $course = Course2::where('name', $request->course_name)
                             ->orderBy('description', 'desc')
                             ->first();
            if (!$course) {
                Log::error('Course not found: ' . $request->course_name);
                return redirect()->back()->withErrors(['error' => 'Course not found.']);
            }
    
            // Handle user image upload
            $userImage = null;
            if ($request->hasFile('user_image')) {
                $image = $request->file('user_image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public/images', $filename);
    
                // Check for white background using GD library
                $isWhiteBackground = $this->checkWhiteBackground(storage_path('app/' . $imagePath));
                if (!$isWhiteBackground) {
                    Log::error('Image background is not white: ' . $filename);
                    return redirect()->back()->withErrors(['error' => 'The image background must be white.']);
                }
    
                $userImage = 'images/' . $filename;
            } else {
                return redirect()->back()->withErrors(['error' => 'User image is required.']);
            }
    
            // Generate a unique username
            $randomNumber = str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT);
            $username = strtolower($request->fname . '_' . $randomNumber);
    
            while (User::where('username', $username)->exists()) {
                $randomNumber = str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT);
                $username = strtolower($request->fname . '_' . $randomNumber);
            }
    
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
    
            // Start database transaction
            DB::beginTransaction();
    
            // Create user
            Log::info('Creating user...');
            $user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'username' => $username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telephone' => $request->telephone,
                'location' => $request->location,
                'course_place' => $request->course_place,
                'course22_id' => $course->id,  // Corrected this line
                'user_image' => $userImage,
                'qr_code_path' => $qrCodePath,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'national_number' => $request->national_number,
                'course_time_hour' => $request->course_time_hour,
                'course_time_minute' => $request->course_time_minute,
                'course_time_ampm' => $request->course_time_ampm,
                'course_time_day_month_year' => \Carbon\Carbon::createFromFormat('d-m-Y', $request->course_time_day_month_year)->toDateString(),
            ]);
    
            Log::info('User created with ID: ' . $user->id);
    
            // Create profile3 entry
            Log::info('Creating profile3...');
            $user->profile3()->create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'location' => $request->location,
                'course_place' => $request->course_place,
                'course22_id' => $course->id,  // Corrected this line
                'user_image' => $userImage,
                'qr_code_path' => $qrCodePath,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'national_number' => $request->national_number,
                'course_time_hour' => $request->course_time_hour,
                'course_time_minute' => $request->course_time_minute,
                'course_time_ampm' => $request->course_time_ampm,
                'course_time_day_month_year' => \Carbon\Carbon::createFromFormat('d-m-Y', $request->course_time_day_month_year)->toDateString(),
            ]);
    
            Log::info('Profile3 created for user ID: ' . $user->id . ' with course22_id: ' . $course->id);
    
            // Commit transaction
            DB::commit();
    
            // Login the user
            Auth::login($user);
    
            return redirect('/home');
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            Log::error('Registration Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred during registration. Please try again.']);
        }
    }
    

public function showRegistrationForm()
{
    if (auth()->check()) {
        return redirect('/home'); // Redirect if already authenticated
    }

    // Fetch all courses
    $courses = Course2::all();

    // Group by course name and select the course with the highest description for each name
    $uniqueCourses = $courses->groupBy('name')->map(function ($group) {
        return $group->sortByDesc('description')->first();
    })->values();

    return view('auth.register', ['courses' => $uniqueCourses]);
}




    
    private function checkWhiteBackground($imagePath)
    {
        $image = imagecreatefromstring(file_get_contents($imagePath));
        if (!$image) {
            return false;
        }

        $width = imagesx($image);
        $height = imagesy($image);

        // Check the top-left corner
        $rgb = imagecolorat($image, 0, 0);
        $colors = imagecolorsforindex($image, $rgb);

        // Define the white color threshold
        $threshold = 10;
        $isWhite = ($colors['red'] > (255 - $threshold) &&
                    $colors['green'] > (255 - $threshold) &&
                    $colors['blue'] > (255 - $threshold));

        imagedestroy($image);

        return $isWhite;
    }
}
