<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $adminRole = Role::create(['name'=>'admin']);
        $teacherRole = Role::create(['name'=>'teacher']);
        $studentRole = Role::create(['name'=>'student']);

        User::create([
            'full_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone' => '9843000000',
            'role_id' => $adminRole->id,
            'status' => 1,
        ]);
        User::create([
            'full_name' => 'Teacher',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password'),
            'phone' => '9843000000',
            'role_id' => $teacherRole->id,
            'status' => 1,
        ]);
        User::create([
            'full_name' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'phone' => '9843000000',
            'role_id' => $studentRole->id,
            'status' => 1,
        ]);
    }
}
