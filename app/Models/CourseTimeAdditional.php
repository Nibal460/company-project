<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTimeAdditional extends Model
{
    use HasFactory;

    // Specify the correct table name
    protected $table = 'course_time_additional';
    
    protected $fillable = [
        'user_id',
        'profile3_id',
        'start_date1',
        'end_date1',
        'awarding1',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseProfile3()
    {
        return $this->belongsTo(CourseProfile3::class, 'profile3_id');
    }
}

