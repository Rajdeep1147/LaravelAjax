<?php

namespace Database\Seeders;

use App\Models\contact;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => Hash::make('password'),
        ]);
        contact::create([
            'address' => '123 Main St',
            'phone_number' => '1234567890',
            'user_id' => 1,
        ]);
        // Create multiple posts for user ID 1
        Post::create([
            'title' => 'First Post',
            'content' => Faker::create()->paragraph(6),
            'user_id' => 1,
        ]);

        Post::create([
            'title' => 'Second Post',
            'content' => Faker::create()->paragraph(6),
            'user_id' => 1,
        ]);

        Post::create([
            'title' => 'Third Post',
            'content' => Faker::create()->paragraph(6),
            'user_id' => 1,
        ]);
    }
}
