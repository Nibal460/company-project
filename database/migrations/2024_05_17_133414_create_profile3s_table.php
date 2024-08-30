<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profile3s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // Foreign key referencing the users table
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->string('location'); // Directly include the location attribute in the profiles table
            $table->string('qr_code_path')->nullable();
            $table->timestamps();
        
            // Define the foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });    
        
    }

    
    
    
    public function down(): void
    {
        Schema::table('profile3s', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('profile3s');
    }
};


