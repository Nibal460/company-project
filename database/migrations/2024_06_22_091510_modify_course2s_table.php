<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCourse2sTable extends Migration
{
    public function up()
    {
        Schema::table('course2s', function (Blueprint $table) {
            if (Schema::hasColumn('course2s', 'date')) {
                $table->dropColumn('date');
            }
            if (!Schema::hasColumn('course2s', 'description')) {
                $table->integer('description')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('course2s', function (Blueprint $table) {
            if (!Schema::hasColumn('course2s', 'date')) {
                $table->date('date');
            }
            if (Schema::hasColumn('course2s', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
}
