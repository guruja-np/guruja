<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminUser = User::create([
            'full_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone' => '9843000000',
            'status' => 1,
        ]);
        $adminUser->assignRole('admin');

        $teacherUser = User::create([
            'full_name' => 'Teacher',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password'),
            'phone' => '9843000000',
            'status' => 1,
        ]);
        $teacherUser->assignRole('teacher');

        $studentUser = User::create([
            'full_name' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'phone' => '9843000000',
            'status' => 1,
        ]);
        $studentUser->assignRole('student');
    }
}
