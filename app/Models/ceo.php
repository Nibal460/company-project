<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ceo extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'ceos'; // Explicitly specify the table name

    protected $fillable = [
        'first_name', 'last_name', 'gender', 'email', 'password', 'details', 'qr_code_path',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
