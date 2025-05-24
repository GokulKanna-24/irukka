<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'groot@gmail.com';

        if (!User::where('email', $email)->exists()) {
            User::create([
                'name' => 'Groot',
                'email' => $email,
                'password' => Hash::make('Happy@2025'),
                'role' => 'admin',
            ]);
        }
    }
}
