<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Abdelrahman Salah',
                'email' => 'abdelrahman@gmail.com',
                'username' => 'abdelrahman',
                'phone_number' => '01063446527',
                'password' => 'password',
                'super_admin' => 1,
            ],
            [
                'name' => 'Omar Hassan',
                'email' => 'omar@example.com',
                'username' => 'omar',
                'phone_number' => '+201234567892',
                'password' => 'password',
                'super_admin' => 0,
            ],
            [
                'name' => 'Mona Ali',
                'email' => 'mona@example.com',
                'username' => 'mona',
                'phone_number' => '+201234567893',
                'password' => 'password',
                'super_admin' => 0,
            ],
            [
                'name' => 'Ahmed Nabil',
                'email' => 'ahmed@example.com',
                'username' => 'ahmed',
                'phone_number' => '+201234567894',
                'password' => 'password',
                'super_admin' => 0,
            ],
            [
                'name' => 'Sara Ahmed',
                'email' => 'sara@example.com',
                'username' => 'sara',
                'phone_number' => '+201234567891',
                'password' => 'password',
                'super_admin' => 0,
            ],
        ];
        foreach ($admins as $admin) {
            Admin::create([
                'store_id' => Store::inRandomOrder()->first()->id,
                'name' => $admin['name'],
                'email' => $admin['email'],
                'username' => $admin['username'],
                'phone_number' => $admin['phone_number'],
                'password' => Hash::make($admin['password']),
                'super_admin' => $admin['super_admin'],
            ]);
        }
    }
}
