<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Student::factory(9)->create();
        $this->call([StudentSeeder::class]);
        $this->call([AdminSeeder::class]);
        $this->call([CentreSeeder::class]);
        $this->call([BranchSeeder::class]);

    }
}
