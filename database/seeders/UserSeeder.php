<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mo Salah',
            'email' => 'mo@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '01063446528',
            'type' => 'admin',
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Abdo Salah',
                'email' => 'abdo@gmail.com',
                'password' => Hash::make('password'),
                'phone_number' => '01063446527',
                'type' => 'super-admin',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name' => 'Ahmed Mohamed',
                'email' => 'ahmed@gmail.com',
                'password' => Hash::make('password'),
                'phone_number' => '01011112222',
                'type' => 'user',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name' => 'Omar Hassan',
                'email' => 'omar@gmail.com',
                'password' => Hash::make('password'),
                'phone_number' => '01055556666',
                'type' => 'user',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}
