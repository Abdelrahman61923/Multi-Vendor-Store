<?php

namespace App\Models;

use App\Concens\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends User
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $fillable = [
        'name', 'email', 'username', 'phone_number', 'password', 'status', 'super_admin', 'last_active_at'
    ];
}
