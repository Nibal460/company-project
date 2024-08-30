<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRememberTokenToCeosTable extends Migration
{
    public function up()
    {
        Schema::table('ceos', function (Blueprint $table) {
            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::table('ceos', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
    }
}
