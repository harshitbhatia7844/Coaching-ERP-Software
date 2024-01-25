<?php

namespace Database\Seeders;

use App\Models\branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        branch::create([
            'branch_id' => '721',
            'name' => 'default',
            'location' => 'default',
            'status' => 0,
            'centre_id' => 'CINDUP1000001'
        ]);
    }
    
}
