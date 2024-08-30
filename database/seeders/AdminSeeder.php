<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder //Admin Account
{
    public function run()
    {
        Admin::create([
            'fname' => 'Ali',
            'lname' => 'Mohamed',
            'email' => 'Techturncompany@gmail.com',
            'password' => Hash::make('Good#Company2*4'),
            'username' => 'Ali_378432',
            'telephone' => '77643356436',
            'location' => 'Damascus',
        ]);
    }
}
