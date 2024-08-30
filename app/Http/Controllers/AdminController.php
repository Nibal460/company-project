<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course2;
use App\Models\Profile3;
use App\Models\Teacher;
use App\Models\Manager;
use App\Models\Ceo;
use App\Models\CourseTime;
use App\Events\UserDeleted;
use App\Models\CourseTimeAdditional;
use App\Models\CourseProfile3;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Image;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::guard('admin')->check()) {
                return redirect()->route('admin.login.post');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $coursePlace = $request->input('course_place');
        $courseName = $request->input('course_name');
        $description = $request->input('description');

        $courses = Course2::all();
        $descriptions = Course2::select('name', 'description')->get();

        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where(function($query) use ($search) {
                    $query->where('fname', 'like', "%$search%")
                          ->orWhere('lname', 'like', "%$search%")
                          ->orWhere('email', 'like', "%$search%");
                })
                ->orWhereHas('profile3.courseProfile3s', function ($query) use ($search) {
                    $query->where('course_name', 'like', "%$search%");
                });
            })
            ->when($coursePlace, function ($query, $coursePlace) {
                return $query->whereHas('profile3', function ($query) use ($coursePlace) {
                    $query->where('course_place', $coursePlace)
                          ->orWhereHas('courseProfile3s', function ($query) use ($coursePlace) {
                              $query->where('course_place', $coursePlace);
                          });
                });
            })
            ->when($courseName, function ($query) use ($courseName) {
                return $query->where(function ($query) use ($courseName) {
                    $query->whereHas('course2', function ($query) use ($courseName) {
                        $query->where('name', $courseName);
                    })
                    ->orWhereHas('profile3.courseProfile3s', function ($query) use ($courseName) {
                        $query->where('course_name', $courseName);
                    });
                });
            })
            ->when($description, function ($query) use ($courseName, $description) {
                return $query->where(function ($query) use ($courseName, $description) {
                    $query->whereHas('course2', function ($query) use ($courseName, $description) {
                        $query->where('name', $courseName)
                              ->where('description', $description);
                    })
                    ->orWhereHas('profile3.courseProfile3s', function ($query) use ($courseName, $description) {
                        $query->where('course_name', $courseName)
                              ->whereHas('course2', function ($query) use ($description) {
                                  $query->where('description', $description);
                              });
                    });
                });
            })
            ->get();

        return view('admin.users.index', compact('users', 'courses', 'descriptions'));
    }

    public function createCourse()
    {
        $courses = Course2::all();
        return view('admin.add_course', compact('courses'));
    }

    public function storeCourse(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'hours' => 'required|integer|min:1',
    ]);

    // Create a new course instance and fill it with the validated data
    $course = new Course2();
    $course->name = $request->input('name');
    $course->hours = $request->input('hours');
    // Description is automatically set in the boot method of the model
    $course->save(); // Save the course to the database

    // Redirect back to the course creation form with a success message
    return redirect()->route('admin.courses.create')->with('success', 'Course added successfully.');
}


    
    
    public function showCourses()
    {
        $courses = Course2::all(); // Fetch all courses
        return view('admin.add_course', ['courses' => $courses]);
    }

    public function destroyCourse($id)
    {
        // Find the course by its ID
        $course = Course2::findOrFail($id);

        // Delete the course
        $course->delete();

        // Redirect back to the courses index page with a success message
        return redirect()->route('admin.courses.create')->with('success', 'Course removed successfully.');
    }

    public function createTeacher()
    {
        $teachers = Teacher::all();
        return view('admin.add_teacher', compact('teachers'));
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

        $teacher = Teacher::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $qrCodeText = $request->email;
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodePath = 'qrcodes/' . uniqid() . '.svg';
        $qrCodeAbsolutePath = storage_path('app/public/' . $qrCodePath);

        $writer->writeFile($qrCodeText, $qrCodeAbsolutePath);

        $teacher->qr_code_path = $qrCodePath;
        $teacher->save();

        Log::info('QR code generated at: ' . $qrCodePath);

        return redirect()->route('admin.teachers.create')->with('success', 'Teacher added successfully.');
    }

    public function showTeacherQrCode($id)
    {
        $teacher = Teacher::findOrFail($id);

        if (!$teacher->qr_code_path) {
            return redirect()->back()->withErrors('QR code not found for this teacher.');
        }

        return view('admin.teachers.qrcode', compact('teacher'));
    }

    public function showManagerQrCode($id)
    {
        $manager = Manager::findOrFail($id);

        if (!$manager->qr_code_path) {
            return redirect()->back()->withErrors('QR code not found for this manager.');
        }

        return view('admin.managers.qrcode', compact('manager'));
    }

    public function showCeoQrCode($id)
    {
        $ceo = Ceo::findOrFail($id);

        if (!$ceo->qr_code_path) {
            return redirect()->back()->withErrors('QR code not found for this CEO.');
        }

        return view('admin.ceos.qrcode', compact('ceo'));
    }

    public function destroyTeacher(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('admin.teachers.create')->with('success', 'Teacher removed successfully.');
    }

    public function createManager()
    {
        $managers = Manager::all();
        return view('admin.add_manager', compact('managers'));
    }

    public function storeManager(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'email' => 'required|email|unique:managers,email',
            'password' => 'required|string|min:8',
        ]);

        $manager = Manager::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $qrCodeText = $request->email;
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodePath = 'qrcodes/' . uniqid() . '.svg';
        $qrCodeAbsolutePath = storage_path('app/public/' . $qrCodePath);

        $writer->writeFile($qrCodeText, $qrCodeAbsolutePath);

        $manager->qr_code_path = $qrCodePath;
        $manager->save();

        Log::info('QR code generated at: ' . $qrCodePath);

        return redirect()->route('admin.managers.create')->with('success', 'Manager added successfully.');
    }

    public function createCeoManager()
    {
        $ceos = Ceo::all();
        return view('admin.add_ceo_manager', compact('ceos'));
    }

    public function downloadQrCode($id)
{
    // Logic to find and download QR code
    $user = User::findOrFail($id);

    if (!$user->qr_code_path) {
        return redirect()->back()->withErrors('QR code not found for this user.');
    }

    // Assuming the QR code is stored in storage/app/public/qrcodes/
    $filePath = storage_path('app/public/' . $user->qr_code_path);

    return response()->download($filePath, 'qr_code.png');
}
    public function storeCeoManager(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'email' => 'required|email|unique:ceos,email',
            'password' => 'required|string|min:8',
            'details' => 'nullable|string',
        ]);
    
        // Create the CEO manager
        $ceoManager = Ceo::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'details' => $request->details,
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
    
        // Save QR code path to the ceo manager
        $ceoManager->qr_code_path = $qrCodePath;
        $ceoManager->save();
    
        Log::info('QR code generated at: ' . $qrCodePath);
    
        return redirect()->route('admin.ceo_managers.create')->with('success', 'CEO Manager added successfully.');
    }
    
    public function destroyUser($id)
    {
        try {
            $user = User::findOrFail($id);
    
            // Logging user details
            Log::info('Attempting to delete user: ', ['user' => $user->toArray()]);
    
            // Delete related course times
            $courseTimesDeleted = $user->courseTimes()->delete();
            Log::info('Deleted course times', ['count' => $courseTimesDeleted]);
    
            $courseTimeAdditionalsDeleted = $user->courseTimeAdditionals()->delete();
            Log::info('Deleted additional course times', ['count' => $courseTimeAdditionalsDeleted]);
    
            // Delete related profile3
            if ($user->profile3) {
                $user->profile3->delete();
                Log::info('Deleted profile3', ['profile3' => $user->profile3->toArray()]);
            }
    
            // Finally, delete the user
            $user->delete();
            Log::info('User deleted successfully', ['user_id' => $id]);
    
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting user with ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('admin.users.index')->with('error', 'Failed to delete user. Please try again later.');
        }
    }
    
    public function destroyManager($id)
    {
        $manager = Manager::findOrFail($id);
        $manager->delete();
    
        return redirect()->route('admin.managers.create')->with('success', 'Manager deleted successfully.');
    }
    
    public function destroyCeoManager($id)
    {
        try {
            $ceo = Ceo::findOrFail($id);
            $ceo->delete();
            return redirect()->route('admin.ceo_managers.create')->with('success', 'CEO Manager deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting CEO with ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('admin.ceo_managers.create')->with('error', 'Failed to delete CEO. Please try again later.');
        }
    }
    
    public function search(Request $request)
    {
        $search = $request->input('search');
        $location = $request->input('location');
        $coursePlace = $request->input('course_place');
        $courseName = $request->input('course_name');
        $description = $request->input('description');
    
        // Get all courses to populate the dropdown
        $courses = Course2::all();
        $descriptions = Course2::select('name', 'description')->get();
    
        $filteredUsers = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('fname', 'like', "%{$search}%")
                             ->orWhere('lname', 'like', "%{$search}%")
                             ->orWhere('username', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('telephone', 'like', "%{$search}%")
                             ->orWhere('location', 'like', "%{$search}%");
            })
            ->when($location, function ($query, $location) {
                return $query->where('location', $location);
            })
            ->when($coursePlace, function ($query, $coursePlace) {
                return $query->whereHas('profile3', function ($query) use ($coursePlace) {
                    $query->where('course_place', $coursePlace);
                });
            })
            ->when($courseName, function ($query, $courseName) {
                return $query->whereHas('profile3.courseProfile3s.course2', function ($query) use ($courseName) {
                    $query->where('name', 'like', "%{$courseName}%");
                });
            })
            ->when($description, function ($query, $description) {
                return $query->whereHas('profile3.courseProfile3s.course2', function ($query) use ($description) {
                    $query->where('description', $description);
                });
            })
            ->get();
    
        return view('admin.users.index', compact('filteredUsers', 'courses', 'descriptions'));
    }
    
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
    
   // Generate certificate for primary course
   public function generateCertificate(Request $request, $userId, $courseId)
   {
       // Validate the request
       $request->validate([
           'start_date' => 'required|date',
           'end_date' => 'required|date|after_or_equal:start_date',
           'awarding' => 'required|date',
       ]);

       // Fetch user and course details
       $user = User::findOrFail($userId);
       $course = Course2::findOrFail($courseId);

       // Prepare data for the certificate
       $data = [
           'user' => $user,
           'course' => $course,
           'start_date' => $request->start_date,
           'end_date' => $request->end_date,
           'awarding' => $request->awarding,
       ];

       // Return the certificate view with data
       return view('admin.users.certificate', $data); // Adjusted view path
   }

   // Show certificate for first course
   public function showCertificate($userId, $course2Id)
   {
       $user = User::findOrFail($userId);
       $course2 = Course2::findOrFail($course2Id);
   
       $courseTimes = CourseTime::where('user_id', $userId)
                               ->where('course2_id', $course2Id)
                               ->first(); // Assuming there is only one record for simplicity
   
       // Ensure $courseTimes exists before accessing its properties
       if ($courseTimes) {
           $startDate = \Carbon\Carbon::parse($courseTimes->start_date)->format('d-m-Y');
           $endDate = \Carbon\Carbon::parse($courseTimes->end_date)->format('d-m-Y');
           $awarding = \Carbon\Carbon::parse($courseTimes->awarding)->format('F Y');
       } else {
           // Set default values or handle the case where courseTimes is not found
           $startDate = '';
           $endDate = '';
           $awarding = '';
       }
   
       return view('admin.users.certificate', [
           'user' => $user,
           'course2' => $course2, // Corrected variable name to 'course2'
           'startDate' => $startDate,
           'endDate' => $endDate,
           'awarding' => $awarding,
       ]);
   }
   
    
   public function storeCourseTimes(Request $request, $userId, $course2Id)
{
    // Validate the incoming request data
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'awarding' => 'required|date',
    ]);

    // Create or update course times
    $courseTime = CourseTime::updateOrCreate(
        [
            'user_id' => $userId,
            'course2_id' => $course2Id,
        ],
        [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'awarding' => $request->awarding,
        ]
    );

    // Log the course time creation or update
    Log::info('Course time stored successfully', ['course_time' => $courseTime->toArray()]);

    // Redirect to the showCertificate route with both parameters
    return redirect()->route('admin.users.showCertificate', ['user' => $userId, 'course2' => $course2Id])
                     ->with('success', 'Course times stored successfully.');
}

    
    public function storeCourseTimeAdditional(Request $request, $userId, $course2Id)
    {
        // Validate the incoming request data
        $request->validate([
            'additional_info' => 'required|string|max:255',
        ]);
    
        // Create or update additional course times
        $courseTimeAdditional = CourseTimeAdditional::updateOrCreate(
            [
                'user_id' => $userId,
                'course2_id' => $course2Id,
            ],
            [
                'additional_info' => $request->additional_info,
            ]
        );
    
        // Log the additional course time creation or update
        Log::info('Additional course time stored successfully', ['course_time_additional' => $courseTimeAdditional->toArray()]);
    
        return redirect()->route('admin.users.show', $userId)->with('success', 'Additional course times stored successfully.');
    }
   

    public function showCertificateDateForm($userId, $course2Id)
{
    $user = User::findOrFail($userId);
    $course2 = Course2::findOrFail($course2Id);

    return view('admin.users.certificate_date', compact('user', 'course2'));
}


public function showCertificateDateFormForAdditionalCourse(User $user, CourseProfile3 $courseProfile3)
{
    return view('admin.users.certificate_date1', compact('user', 'courseProfile3'));
}

public function storeAdditionalCourseCertificate(Request $request, $userId, $courseProfile3Id)
{
    // Validate the incoming request data
    $request->validate([
        'start_date1' => 'required|date',
        'end_date1' => 'required|date',
        'awarding1' => 'required|date',
    ]);

    // Create or update course times for additional courses
    $courseTimeAdditional = CourseTimeAdditional::updateOrCreate(
        [
            'user_id' => $userId,
            'profile3_id' => $courseProfile3Id,
        ],
        [
            'start_date1' => $request->start_date1,
            'end_date1' => $request->end_date1,
            'awarding1' => $request->awarding1,
        ]
    );

    // Log the course time creation or update
    Log::info('Additional course time stored successfully', ['course_time_additional' => $courseTimeAdditional->toArray()]);

    // Redirect to the certificate view for additional courses
    return redirect()->route('admin.users.showAdditionalCourseCertificate', ['user' => $userId, 'courseProfile3' => $courseProfile3Id])
                     ->with('success', 'Additional course times stored successfully.');
}




public function generateAdditionalCourseCertificate($userId, $courseProfile3Id)
{
    try {
        // Find the user and additional course details
        $user = User::findOrFail($userId);
        $courseProfile3 = CourseProfile3::findOrFail($courseProfile3Id);

        // Example logic to generate and save the additional course certificate
        // Replace this with your actual certificate generation logic
        
        // Assuming you have a method to generate the certificate path or content
        $certificatePath = $this->generateCertificate($user, $courseProfile3);

        // Example: Save the certificate path to the user record
        $user->additional_certificate_path = $certificatePath;
        $user->save();

        // Redirect back to show additional course certificate view with success message
        return redirect()->route('admin.users.showAdditionalCourseCertificate', [$userId, $courseProfile3Id])
                         ->with('success', 'Additional course certificate generated successfully.');
    } catch (\Exception $e) {
        // Handle any exceptions that might occur
        return redirect()->back()->with('error', 'Failed to generate additional course certificate.');
    }
    
}

public function showAdditionalCourseCertificate($userId, $courseProfile3Id)
{
    $user = User::findOrFail($userId);
    $courseProfile3 = CourseProfile3::findOrFail($courseProfile3Id);

    $courseTimeAdditional = CourseTimeAdditional::where('user_id', $userId)
                                                ->where('profile3_id', $courseProfile3Id)
                                                ->first(); // Assume only one record for simplicity

    if (!$courseTimeAdditional) {
        return redirect()->route('admin.users.show', $userId)->with('error', 'No course time records found.');
    }

    $startDate1 = \Carbon\Carbon::parse($courseTimeAdditional->start_date1)->format('d-m-Y');
    $endDate1= \Carbon\Carbon::parse($courseTimeAdditional->end_date1)->format('d-m-Y');
    $awarding1 = \Carbon\Carbon::parse($courseTimeAdditional->awarding1)->format('F Y');

    return view('admin.users.certificate1', [
        'user' => $user,
        'courseProfile3' => $courseProfile3,
        'startDate1' => $startDate1,
        'endDate1' => $endDate1,
        'awarding1' => $awarding1,
    ]);
}


public function generateCertificatePDF(User $user)
{
    // Assuming you have the necessary data to pass to the view
    $course2 = $user->course2;
    $courseTimes = CourseTime::where('user_id', $user->id)
                             ->where('course2_id', $course2->id)
                             ->first();

    $startDate = \Carbon\Carbon::parse($courseTimes->start_date)->format('d-m-Y');
    $endDate = \Carbon\Carbon::parse($courseTimes->end_date)->format('d-m-Y');
    $awarding = \Carbon\Carbon::parse($courseTimes->awarding)->format('F Y');

    $pdf = PDF::loadView('admin.users.certificate', compact('user', 'course2', 'courseTimes', 'startDate', 'endDate', 'awarding'));

    return $pdf->download('certificate.pdf');
}


    }
    
