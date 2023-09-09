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
        //$this->call(CodeSeeder::class);
        $this->call(Code2Seeder::class);
        $this->call(Code3Seeder::class);
        $this->call(Code4Seeder::class);
        $this->call(Code5Seeder::class);
        $this->call(Code6Seeder::class);
        $this->call(Code7Seeder::class);
        $this->call(Code8Seeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
