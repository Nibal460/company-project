<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course2;
use App\Models\Profile3;
use App\Models\CourseProfile3;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class CourseController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'course_place' => 'required|string|max:255',
            'course_name' => 'required|string|max:255',
            'course_time_hour' => 'required|string|max:2',
            'course_time_minute' => 'required|string|max:2',
            'course_time_ampm' => 'required|string|max:2',
            'course_time_day_month_year' => 'required|date_format:d-m-Y',
        ]);
    
        try {
            // Log the request data
            Log::info('Request data: ', $request->all());
    
            // Find the course with the highest description for the given name
            $course = Course2::where('name', $request->course_name)
                             ->orderBy('description', 'desc')
                             ->first();
    
            if (!$course) {
                Log::error('Course not found: ' . $request->course_name);
                return redirect()->back()->withErrors(['error' => 'Course not found.']);
            }
    
            // Log course data
            Log::info('Course found: ', $course->toArray());
    
            $user = Auth::user();
            $profile3 = $user->profile3;
    
            // Ensure profile3 exists
            if (!$profile3) {
                Log::error('Profile not found for user: ' . $user->id);
                return redirect()->back()->withErrors(['error' => 'Profile not found.']);
            }
    
            // Log profile data
            Log::info('Profile found: ', $profile3->toArray());
    
            // Add new course to the user's profile
            $profile3->courseProfile3s()->create([
                'course2_id' => $course->id, // Add course ID
                'course_name' => $request->course_name,
                'course_place' => $request->course_place,
                'course_time_hour' => $request->course_time_hour,
                'course_time_minute' => $request->course_time_minute,
                'course_time_ampm' => $request->course_time_ampm,
                'course_time_day_month_year' => Carbon::createFromFormat('d-m-Y', $request->course_time_day_month_year)->toDateString(),
            ]);

            Log::info('Course attached successfully.');

            return redirect()->back()->with('success', 'Course added successfully!');
        } catch (QueryException $e) {
            Log::error('Database error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Database error: ' . $e->getMessage()]);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
    

    public function showAddCourseForm()
    {
        // Fetch unique course names with the highest description value
        $courses = Course2::select('name', DB::raw('MAX(description) as description'))
            ->groupBy('name')
            ->get();

        return view('course.add', compact('courses'));
    }
}
