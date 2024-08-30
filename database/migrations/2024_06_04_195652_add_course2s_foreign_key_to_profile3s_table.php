<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourse2sForeignKeyToProfile3sTable extends Migration
{
    public function up()
    {
        Schema::table('profile3s', function (Blueprint $table) {
            $table->foreignId('course22_id')->nullable()->constrained('course2s')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('profile3s', function (Blueprint $table) {
            $table->dropForeign(['course22_id']);
            $table->dropColumn('course22_id');
        });
    }
}
