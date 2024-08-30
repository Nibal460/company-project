<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseProfile3 extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile3_id',
        'course2_id',
        'course_place',
        'course_name',
        'course_time_hour',
        'course_time_minute',
        'course_time_ampm',
        'course_time_day_month_year',
    ];

    public function profile3()
    {
        return $this->belongsTo(Profile3::class, 'profile3_id');
    }

    public function course2()
    {
        return $this->belongsTo(Course2::class, 'course2_id');
    }
}

