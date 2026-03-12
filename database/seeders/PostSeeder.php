<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::query()
            ->whereIn('email', [
                'mara.velasco@example.com',
                'noel.arrieta@example.com',
                'ivy.salonga@example.com',
            ])
            ->orderBy('email')
            ->pluck('id')
            ->values();

        if ($userIds->isEmpty()) {
            return;
        }

        $posts = [
            [
                'title' => 'A Quiet Night Can Still Change Everything',
                'content' => 'Some nights feel ordinary until one conversation, one message, or one memory changes your whole direction. Slow evenings still carry momentum when you pay attention.',
            ],
            [
                'title' => 'Small Wins Matter More Than Loud Announcements',
                'content' => 'Progress is usually quiet. A completed draft, a cleaner design, a fixed bug, or one brave decision can matter more than public noise. Stack the small wins and let the results speak later.',
            ],
            [
                'title' => 'Why Starting Again Is Not the Same as Failing',
                'content' => 'Restarting does not erase what you learned the first time. It means you now return with better judgment, stronger instincts, and less fear of the work ahead.',
            ],
            [
                'title' => 'Build the Habit Before You Chase the Outcome',
                'content' => 'The outcome will always feel far away if the daily habit is missing. Choose a rhythm you can repeat, then trust repetition to do what motivation cannot.',
            ],
            [
                'title' => 'There Is Value in Writing Things Down',
                'content' => 'Thoughts become clearer when they leave your head and land on a page. Writing reveals what you actually mean, what still feels weak, and what is ready to be shared.',
            ],
            [
                'title' => 'Optimism Works Better When It Has Structure',
                'content' => 'Hope is useful, but hope with a plan is better. Give your optimism a schedule, a checklist, and a next step so it can move from emotion into action.',
            ],
        ];

        collect($posts)->each(function (array $post, int $index) use ($userIds): void {
            $createdAt = now()->subHours(($index + 1) * 3);

            Post::query()->updateOrCreate(
                ['title' => $post['title']],
                [
                    'user_id' => $userIds[$index % $userIds->count()],
                    'content' => $post['content'],
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ],
            );
        });
    }
}
