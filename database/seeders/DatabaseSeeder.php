<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\category;
use App\Models\Machanic;
use App\Models\Owner;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Result;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a default test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Call other seeders
        $this->call(UserSeeder::class);

        // Create other related models
        Owner::factory(5)->create();
        Car::factory(10)->create();
        Machanic::factory(10)->create();

        // Create 10 students
        $students = Student::factory(10)->create();

        // Create variable number of results for each student
        $students->each(function ($student) {
            // Random number between 1 and 3 results per student
            $resultCount = rand(1, 3);

            Result::factory($resultCount)->create([
                'student_id' => $student->id,
            ]);
        });
    }

}
