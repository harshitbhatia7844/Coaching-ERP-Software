<?php

namespace Database\Seeders;
use App\Models\Student;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('student'),
            'mobile_no' => '9876543210',
            'gender' => 'Male',
            'city' => 'Noida',
            'state' => 'Uttar Pradesh',
            'centre_id' => 'CINDUP1000001',
            'branch_id' => 721
        ]);
    }
}
