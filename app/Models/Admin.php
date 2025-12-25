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

    public static function rules($id = 0)
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', "unique:admins,username,$id"],
            'email' => ['required', 'string', 'email', 'max:255', "unique:admins,email,$id"],
            'phone_number' => ['required', 'string','max:20', "unique:admins,phone_number,$id"],
            'roles' => ['required', 'array'],
        ];
    }

    // Relations
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
