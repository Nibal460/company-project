<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCourseTimeFromUsersAndProfile3s extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'course_time')) {
                $table->dropColumn('course_time');
            }
        });

        Schema::table('profile3s', function (Blueprint $table) {
            if (Schema::hasColumn('profile3s', 'course_time')) {
                $table->dropColumn('course_time');
            }
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
            $table->string('course_time')->nullable();
        });

        Schema::table('profile3s', function (Blueprint $table) {
            $table->string('course_time')->nullable();
        });
    }
}
