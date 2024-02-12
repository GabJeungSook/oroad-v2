<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'OROAD ADMIN',
                'email' => 'sksuoroad@sksu.edu.ph',
                'password' => Hash::make('sksuoroad2024'),
            ],
        ]);
    }
}
