<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ReorderUserIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Reorder IDs
        $users = DB::table('users')->orderBy('id')->get();
        $new_id = 1;
        foreach ($users as $user) {
            DB::table('users')->where('id', $user->id)->update(['id' => $new_id]);
            $new_id++;
        }

        // Reset Auto-Increment
        $new_auto_increment_value = $new_id;
        DB::statement("ALTER TABLE users AUTO_INCREMENT = $new_auto_increment_value;");
        
        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Code to reverse the migrations if necessary
    }
}
