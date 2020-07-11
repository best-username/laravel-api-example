<?php

use App\User;
use App\Author;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate existing records to start from scratch.
        Author::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $author = new Author([
                'name' => $faker->name,
                'surname' => $faker->lastName,
            ]);
            $author->creator()->associate(User::inRandomOrder()->first());
            $author->save();
        }
    }
}