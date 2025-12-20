<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'username', 'phone_number', 'password', 'status', 'super_admin', 'last_active_at'
    ];
}
