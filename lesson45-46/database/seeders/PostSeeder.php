<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected const POSTS_COUNT = 150;

    public function run(): void
    {

        $faker = Factory::create('ru_RU');

        DB::table('posts')->truncate();

        $this->command->info('Создание постов...');

        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $categories = DB::table('categories')->get();
        $users = DB::table('users')->get();
        $categoryNames = $categories->pluck('name', 'id')->toArray();



        $postsData = [];
        for ($i = 0; $i < static::POSTS_COUNT; $i++) {
            $categoryId = $faker->randomElement($categoryIds);
            $categoryName = $categoryNames[$categoryId];

            $postsData[] = [
                'title' => $this->generateTitle($faker, $categoryName),
                'content' => $this->generateContent($faker, $categoryName),
                'category_id' => $categoryId,
                'user_id' => $users->random()->id,
            ];
        }

        DB::table('posts')->insert($postsData);
        $this->command->info('Создано ' . static::POSTS_COUNT . ' постов');
    }

    private function generateTitle($faker, $categoryName): string
    {
        $templates = [
            "Основы работы с {$categoryName}",
            "Продвинутые техники в {$categoryName}",
            "Как начать изучать {$categoryName}",
            "Лучшие практики {$categoryName}",
            "{$categoryName} для начинающих",
            "Секреты {$categoryName}",
            "{$categoryName}: от А до Я",
            "Современный {$categoryName}",
            "{$categoryName} в реальных проектах",
            "Оптимизация в {$categoryName}"
        ];

        return $faker->randomElement($templates);
    }

    private function generateContent($faker, $categoryName): string
    {
        $intro = "В этой статье мы подробно разберем тему {$categoryName}.";
        $body = $faker->realText(rand(500, 1000));
        $conclusion = "Изучение {$categoryName} открывает новые возможности для профессионального роста.";

        return implode("\n\n", [$intro, $body, $conclusion]);
    }
}
