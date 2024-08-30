<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_course_place_to_profile3s_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\Schema;

class AddCoursePlaceToProfile3sTable extends Migration
{
    public function up()
    {
        Schema::table('profile3s', function (Blueprint $table) {
            $table->string('course_place')->nullable();
        });
    }

    public function down()
    {
        Schema::table('profile3s', function (Blueprint $table) {
            $table->dropColumn('course_place');
        });
    }
}

