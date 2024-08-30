<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHoursToCourse2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course2s', function (Blueprint $table) {
            $table->integer('hours')->nullable(); // Add hours column, nullable is optional
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course2s', function (Blueprint $table) {
            $table->dropColumn('hours');
        });
    }
}
