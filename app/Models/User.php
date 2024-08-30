<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Events\UserDeleted;
use App\Models\Profile3;
use App\Models\Course2;
use App\Models\CourseProfile3;
use App\Models\CourseTime;
use App\Models\CourseTimeAdditional;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fname',
        'lname',
        'father_name',
        'mother_name',
        'username',
        'email',
        'password',
        'telephone',
        'national_number',
        'location',
        'qr_code_path',
        'user_image',
        'course_place',
        'course_time_hour',
        'course_time_minute',
        'course_time_ampm',
        'course_time_day_month_year',
        'course22_id', // Ensure this field is fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dispatchesEvents = [
        'deleted' => UserDeleted::class,
    ];

    public function profile3(): HasOne
    {
        return $this->hasOne(Profile3::class);
    }

    public function course2s(): BelongsToMany
    {
        return $this->belongsToMany(Course2::class, 'course_profile3', 'profile3_id', 'course2_id')
                    ->withPivot('course_place', 'course_name', 'course_time_hour', 'course_time_minute', 'course_time_ampm', 'course_time_day_month_year')
                    ->withTimestamps();
    }

    public function additionalCourses(): HasManyThrough
    {
        return $this->hasManyThrough(CourseProfile3::class, Profile3::class, 'user_id', 'profile3_id');
    }

    public function course2()
    {
        return $this->belongsTo(Course2::class, 'course22_id');
    }

    public function courseTimes(): HasMany
    {
        return $this->hasMany(CourseTime::class);
    }

    public function courseTimeAdditionals(): HasMany
    {
        return $this->hasMany(CourseTimeAdditional::class);
    }
}
