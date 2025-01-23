<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Floris Meccanici',
            'email' => 'florismeccanici@tutanota.com',
            'password' => Hash::make('secret'),
            'email_verified_at' => now(),
        ]);
    }
} 