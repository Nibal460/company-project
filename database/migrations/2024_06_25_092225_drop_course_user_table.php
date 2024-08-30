<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCourseUserTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('course_user');
    }

    public function down()
    {
        Schema::create('course_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('course22_id'); 
            $table->foreign('course22_id')->references('id')->on('course2s')->onDelete('cascade');
            $table->string('course_place');
            $table->string('course_time_hour');
            $table->string('course_time_minute');
            $table->string('course_time_ampm');
            $table->date('course_time_day_month_year');
            $table->timestamps();
        });
    }
}
