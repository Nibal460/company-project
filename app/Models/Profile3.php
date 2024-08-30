<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile3 extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'father_name',
        'mother_name',
        'email',
        'telephone',
        'national_number',
        'location',
        'course_place',
        'qr_code_path',
        'user_image',
        'course_time_hour',
        'course_time_minute',
        'course_time_ampm',
        'course_time_day_month_year',
        'course22_id', // Ensure this field is fillable
    ];

    // Define relationship to the User model
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Custom accessor to get the username attribute from the related User model
    public function getUsernameAttribute(): string
    {
        return $this->user->username; // Assuming 'username' exists in the User model
    }

    // Define many-to-many relationship to the Course2 model via 'course_profile3s' pivot table
    public function course2s(): BelongsToMany
    {
        return $this->belongsToMany(Course2::class, 'course_profile3s', 'profile3_id', 'course2_id')
                    ->withPivot(['course_place', 'course_time_hour', 'course_time_minute', 'course_time_ampm', 'course_time_day_month_year'])
                    ->withTimestamps();
    }

    // Define a one-to-many relationship with Course2 model
    public function course2(): BelongsTo
    {
        return $this->belongsTo(Course2::class, 'course22_id'); // Adjust 'course22_id' if necessary
    }

    // Define one-to-many relationship with CourseProfile3 model
    public function courseProfile3s(): HasMany
    {
        return $this->hasMany(CourseProfile3::class, 'profile3_id');
    }
    
    public function courseTimeAdditionals()
    {
        return $this->hasMany(CourseTimeAdditional::class);
    }
}
