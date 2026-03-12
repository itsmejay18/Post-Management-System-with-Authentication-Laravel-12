<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        collect([
            ['name' => 'Mara Velasco', 'email' => 'mara.velasco@example.com'],
            ['name' => 'Noel Arrieta', 'email' => 'noel.arrieta@example.com'],
            ['name' => 'Ivy Salonga', 'email' => 'ivy.salonga@example.com'],
        ])->each(function (array $user): void {
            User::query()->firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ],
            );
        });

        $this->call(PostSeeder::class);
    }
}
