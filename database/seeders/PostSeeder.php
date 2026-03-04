<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::insert([
            [
                'title' => 'Welcome to the Post Management System',
                'content' => 'This is the first sample post created by the seeder. You can edit or delete it after logging in.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Laravel CRUD with Authentication',
                'content' => 'This sample demonstrates a protected CRUD setup where authenticated users can manage posts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
