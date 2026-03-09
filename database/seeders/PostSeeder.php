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
                'title' => 'Street Tacos 101',
                'content' => 'Corn tortillas piled with charred carne asada, cilantro, onion, and a squeeze of lime. Keep it simple; let the salsa verde do the talking.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Comfort in a Bowl: Ramen Night',
                'content' => 'Slow-simmered broth, springy noodles, jammy eggs, and crunchy scallions. Build layers of umami with miso, soy, and a touch of chili oil.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'No-Bake Cheesecake Jars',
                'content' => 'Graham cracker crumbs, whipped cream cheese, and fresh berries stacked in jars. Chill for an hour, then eat with a spoon straight from the fridge.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
