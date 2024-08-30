<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseUserTable extends Migration
{
    public function up()
    {
        Schema::create('course_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course2_id'); // Corrected to course2_id
            $table->string('course_place');
            $table->string('course_name'); // Ensure this column exists
            $table->string('course_time_hour');
            $table->string('course_time_minute');
            $table->string('course_time_ampm');
            $table->date('course_time_day_month_year');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course2_id')->references('id')->on('course2s')->onDelete('cascade'); // Corrected to course2_id
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_user');
    }
}
