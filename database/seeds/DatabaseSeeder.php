<?php

use Illuminate\Database\Seeder;
use App\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 3; $i++) {
            Post::create([
                'description' => $faker->sentence,
                'image' => $faker->sentence,
                'tags' => 'monkey, dog, cat, animal, cute',
            ]);
        }
    }
}
