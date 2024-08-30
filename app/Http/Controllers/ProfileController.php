<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Profile3;
use App\Models\Course2;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
{
        $user = Auth::user();
        if ($user) {
            $profile3 = $user->profile3;
            $courses = Course2::all(); // Retrieve all available courses

            // Format the course_time_day_month_year for both user and profile3
            if ($user->course_time_day_month_year) {
                $user->course_time_day_month_year = Carbon::parse($user->course_time_day_month_year)->format('d-m-Y');
            }
            if ($profile3 && $profile3->course_time_day_month_year) {
                $profile3->course_time_day_month_year = Carbon::parse($profile3->course_time_day_month_year)->format('d-m-Y');
            }

            return view('profile3.show', compact('profile3', 'courses','user'));
        } else {
            return redirect('/login');
        }
    }

    

    /**
     * Show the form for editing the user's profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        $profile3 = $user->profile3()->firstOrNew();

        return view('profile3.edit', compact('user', 'profile3'));
    }

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile3 = $user->profile3()->firstOrNew();
    
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::id())],
            'telephone' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'national_number' => 'required|string|max:255|unique:profile3s,national_number,' . $profile3->id,
        ]);
    
        try {
            // Handle user image upload
            if ($request->hasFile('user_image')) {
                $image = $request->file('user_image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public/images', $filename);
                $userImage = 'images/' . $filename;
                $user->user_image = $userImage;
                $profile3->user_image = $userImage;
            }
    
            // Update the profile3 model fields
            $profile3->fname = $validatedData['fname'];
            $profile3->lname = $validatedData['lname'];
            $profile3->father_name = $validatedData['father_name'];
            $profile3->mother_name = $validatedData['mother_name'];
            $profile3->email = $validatedData['email'];
            $profile3->telephone = $validatedData['telephone'];
            $profile3->national_number = $validatedData['national_number'];
            $profile3->location = $validatedData['location']; // Update location
            $profile3->save();
    
            // Update the user model fields
            $user->update([
                'fname' => $validatedData['fname'],
                'lname' => $validatedData['lname'],
                'email' => $validatedData['email'],
                'telephone' => $validatedData['telephone'],
                'location' => $validatedData['location'], // Update location
                'father_name' => $validatedData['father_name'],
                'mother_name' => $validatedData['mother_name'],
                'national_number' => $validatedData['national_number'],
            ]);
    
            return redirect()->route('profile3.show')->with('success', 'Profile updated successfully.');
        } catch (Exception $e) {
            Log::error('Profile update error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the profile. Please try again.']);
        }
    }
    

    



    /**
     * Save the user's answer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveAnswer(Request $request)
    {
        $validatedData = $request->validate([
            'answer' => 'required|in:choice1,choice2,choice3,choice4',
        ]);

        $user = Auth::user();
        $profile3 = $user->profile3()->firstOrNew(); // Retrieve or create profile3 record

        $profile3->answer = $validatedData['answer'];
        $profile3->save();

        $imagePath = '';
        switch ($validatedData['answer']) {
            case 'choice1':
                $imagePath = 'images/industrial11.jpg';
                break;
            case 'choice2':
                $imagePath = 'images/industrial12.jpg';
                break;
            case 'choice3':
                $imagePath = 'images/labor11.jpg';
                break;
            case 'choice4':
                $imagePath = 'images/labor12.jpg';
                break;
        }

        return response()->json(['imagePath' => $imagePath]);
    }
}
