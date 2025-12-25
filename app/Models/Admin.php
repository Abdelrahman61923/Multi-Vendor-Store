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
        'store_id', 'name', 'email', 'username', 'phone_number', 'password', 'super_admin', 'status', 'last_active_at'
    ];
}
