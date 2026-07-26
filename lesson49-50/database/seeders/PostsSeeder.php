<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('categories')->get();
        $users = DB::table('users')->get();

        $faker = Faker::create('ru_RU');
        for ($i = 0; $i < 15; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->realText(20),
                'content' =>$faker->realText(1500),
                'category_id' => $categories->random()->id,
                'user_id' => $users->random()->id,
            ]);
        }

    }
}
