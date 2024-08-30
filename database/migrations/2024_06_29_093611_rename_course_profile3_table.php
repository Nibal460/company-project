<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameCourseProfile3Table extends Migration
{
    public function up()
    {
        if (Schema::hasTable('course_profile3') && !Schema::hasTable('course_profile3s')) {
            Schema::rename('course_profile3', 'course_profile3s');
        }
    }

    public function down()
    {
        if (Schema::hasTable('course_profile3s') && !Schema::hasTable('course_profile3')) {
            Schema::rename('course_profile3s', 'course_profile3');
        }
    }
}
