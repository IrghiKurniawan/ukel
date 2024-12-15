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
        //
        User::create([
            'name' => 'GUEST',
            'email' => 'guest@example.com',
            'password' => Hash::make('guest123'),
            'role' => 'GUEST',
        ]);
        
        User::create([
            'name' => 'STAFF',
            'email' => 'staff@example.com',
            'password' => Hash::make('staf123'),
            'role' => 'STAFF',
        ]);

        User::create([
            'name' => 'HEAD_STAFF',
            'email' => 'headstaff@example.com',
            'password' => Hash::make('headstaf123'),
            'role' => 'HEAD_STAFF',
        ]);
    }
}
