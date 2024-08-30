<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseTimeToProfile3sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile3s', function (Blueprint $table) {
            $table->string('course_time')->after('course22_id')->nullable(); // Adjust the column type if needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile3s', function (Blueprint $table) {
            $table->dropColumn('course_time');
        });
    }
}
