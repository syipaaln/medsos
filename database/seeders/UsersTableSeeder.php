<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'syipa@gmail.com',
            'password' => bcrypt('syipa123'),
            'name' => 'syipaaln',
        ]);
        User::create([
            'email' => 'moiz@gmail.com',
            'password' => bcrypt('moiz1234'),
            'name' => 'moiz',
        ]);
    }
}
