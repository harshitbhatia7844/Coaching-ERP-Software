<?php

namespace Database\Seeders;
use App\Models\Centre;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class CentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Centre::create([
            'centre_id' => 'CINDUP1000001',
            'name' => 'Main Centre',
            'email' => 'maincentre@gmail.com',
            'mobile_no' => '9999999999',
            'contact_person' => 'Head Office',
            'contact_email' => 'head@gmail.com',
            'contact_no' => '9999999999',
            'city' => 'Noida',
            'state' => 'Uttat Pradesh',
            'password' => Hash::make('maincentre'),
        ]);
    }
}
