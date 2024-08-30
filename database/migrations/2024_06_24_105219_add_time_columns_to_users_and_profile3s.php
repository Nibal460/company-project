<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeColumnsToUsersAndProfile3s extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('course_time_hour', 2)->nullable();
            $table->string('course_time_minute', 2)->nullable();
            $table->string('course_time_ampm', 2)->nullable();
            $table->string('course_time_month_year', 7)->nullable(); // Format: MM-YYYY
        });

        Schema::table('profile3s', function (Blueprint $table) {
            $table->string('course_time_hour', 2)->nullable();
            $table->string('course_time_minute', 2)->nullable();
            $table->string('course_time_ampm', 2)->nullable();
            $table->string('course_time_month_year', 7)->nullable(); // Format: MM-YYYY
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['course_time_hour', 'course_time_minute', 'course_time_ampm', 'course_time_month_year']);
        });

        Schema::table('profile3s', function (Blueprint $table) {
            $table->dropColumn(['course_time_hour', 'course_time_minute', 'course_time_ampm', 'course_time_month_year']);
        });
    }
}
