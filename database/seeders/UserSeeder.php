<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Kevin rh',
            'cin' => 'AB123456',
            'email' => 'Kevin@example.com',
            'role' => 'admin',
            'password' => bcrypt('Kevin1234')
        ]);
    }
}
