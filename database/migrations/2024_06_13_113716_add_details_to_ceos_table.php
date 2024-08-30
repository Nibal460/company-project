<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_details_to_ceos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToCeosTable extends Migration
{
    public function up()
    {
        Schema::table('ceos', function (Blueprint $table) {
            $table->text('details')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('ceos', function (Blueprint $table) {
            $table->dropColumn('details');
        });
    }
}
