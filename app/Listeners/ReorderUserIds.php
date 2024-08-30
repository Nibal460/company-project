<?php
namespace App\Listeners;

use App\Events\UserDeleted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReorderUserIds
{
    public function handle(UserDeleted $event)
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        try {
            // Reorder IDs and update foreign keys in related tables
            $users = DB::table('users')->orderBy('id')->get();
            $new_id = 1;
            foreach ($users as $user) {
                $old_id = $user->id;
                DB::table('users')->where('id', $old_id)->update(['id' => $new_id]);
                DB::table('profile3s')->where('user_id', $old_id)->update(['user_id' => $new_id]);
                $new_id++;
            }

            // Reset Auto-Increment
            $new_auto_increment_value = $new_id;
            DB::statement("ALTER TABLE users AUTO_INCREMENT = $new_auto_increment_value;");

        } catch (\Exception $e) {
            Log::error('Failed to reorder user IDs: ' . $e->getMessage());
            throw $e; // Re-throw the exception to let the framework handle it
        } finally {
            // Enable foreign key checks even if an exception occurs
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
