<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseProfile3Table extends Migration
{
    public function up()
    {
        Schema::create('course_profile3s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile3_id');
            $table->unsignedBigInteger('course2_id');
            $table->string('course_place');
            $table->string('course_name');
            $table->string('course_time_hour');
            $table->string('course_time_minute');
            $table->string('course_time_ampm');
            $table->date('course_time_day_month_year');
            $table->timestamps();

            $table->foreign('profile3_id')->references('id')->on('profile3s')->onDelete('cascade');
            $table->foreign('course2_id')->references('id')->on('course2s')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_profile3');
    }
}
