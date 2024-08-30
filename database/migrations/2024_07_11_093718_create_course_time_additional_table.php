<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTimeAdditionalTable extends Migration
{
    public function up()
    {
        Schema::create('course_time_additional', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile3_id');
            $table->unsignedBigInteger('user_id');
            $table->date('start_date1');
            $table->date('end_date1');
            $table->date('awarding1');
            $table->timestamps();

            // Define foreign keys
            $table->foreign('profile3_id')->references('id')->on('course_profile3s')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_time_additional');
    }
}

