<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeleteSpecificAdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->where('email', 'Nibal-Company2024@gmail.com')->delete();
    }
}
