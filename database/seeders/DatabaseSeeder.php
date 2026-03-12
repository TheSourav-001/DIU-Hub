<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $cse = \App\Models\Department::create(['name' => 'Computer Science and Engineering', 'code' => 'CSE']);
        $swe = \App\Models\Department::create(['name' => 'Software Engineering', 'code' => 'SWE']);
        $bba = \App\Models\Department::create(['name' => 'Business Administration', 'code' => 'BBA']);

        \App\Models\Course::insert([
            ['department_id' => $cse->id, 'name' => 'Operating Systems', 'code' => 'CSE313', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => $cse->id, 'name' => 'Data Structures', 'code' => 'CSE214', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => $swe->id, 'name' => 'Software Project Management', 'code' => 'SWE311', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => $bba->id, 'name' => 'Principles of Accounting', 'code' => 'ACT111', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
        // Setup an admin user
        \App\Models\User::factory()->create([
            'name' => 'Admin DIU',
            'email' => 'admin@diu.edu.bd',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);
    }
}
