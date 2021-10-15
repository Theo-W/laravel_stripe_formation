<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::factory(8)->create();

        User::factory(10)->create()->each(function ($user) use ($tags) {
            Event::factory(rand(2,5))->create([
                'user_id' => $user->id
            ])->each(function ($event) use ($tags) {
                $event->tags()->attach($tags->random(3));
            });
        });
    }
}
