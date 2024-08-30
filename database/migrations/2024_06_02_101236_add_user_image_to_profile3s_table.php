<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserImageToProfile3sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('profile3s', function (Blueprint $table) {
        $table->string('user_image')->nullable();
    });
}

public function down()
{
    Schema::table('profile3s', function (Blueprint $table) {
        $table->dropColumn('user_image');
    });
}

}
