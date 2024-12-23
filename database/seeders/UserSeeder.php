<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email'=> 'guest@example.com',
            'password' => hash::make('guest123'),
            'role' => 'GUEST',
        ]);
        User::create([
            'email'=> 'staff@example.com',
            'password' => hash::make('staf123'),
            'role' => 'STAFF',
        ]);
        User::create([
            'email'=> 'hstaff@example.com',
            'password' => hash::make('headstaf123'),
            'role' => 'HEAD_STAFF',
        ]);
    }
}
