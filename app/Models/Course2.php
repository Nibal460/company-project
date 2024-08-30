<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course2 extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'hours', 'description'];

    // Boot method to auto-increment description
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Find the course with the highest description number
            $lastCourse = self::orderBy('description', 'desc')->first();
            // Set the description to be one more than the highest, or 1 if no courses exist
            $model->description = $lastCourse ? $lastCourse->description + 1 : 1;
        });
    }

    // Define many-to-many relationship with Profile3
    public function profiles(): BelongsToMany
    {
        // Ensure pivot table and column names are correct
        return $this->belongsToMany(Profile3::class, 'course_profile3', 'course2_id', 'profile3_id')
                    ->withPivot('course_place', 'course_time_hour', 'course_time_minute', 'course_time_ampm', 'course_time_day_month_year')
                    ->withTimestamps();
    }

    public function courseTimes()
    {
        return $this->hasMany(CourseTime::class);
    }
}
