<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ResetAutoIncrement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Reset auto-increment for users table
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');

        // Reset auto-increment for profile3s table
        DB::statement('ALTER TABLE profile3s AUTO_INCREMENT = 1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Optionally, you can set a specific value for down method, but usually, this is not needed.
    }
}
