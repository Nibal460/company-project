<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCourseTimeColumnsInUsersAndProfile3sTables extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('course_time_day_month_year')->default('2024-07-01')->after('course_time_ampm');
            $table->dropColumn('course_time_month_year');
        });

        Schema::table('profile3s', function (Blueprint $table) {
            $table->date('course_time_day_month_year')->default('1970-07-01')->after('course_time_ampm');
            $table->dropColumn('course_time_month_year');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('course_time_month_year')->after('course_time_ampm');
            $table->dropColumn('course_time_day_month_year');
        });

        Schema::table('profile3s', function (Blueprint $table) {
            $table->string('course_time_month_year')->after('course_time_ampm');
            $table->dropColumn('course_time_day_month_year');
        });
    }
}
