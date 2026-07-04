<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'PHP',
                'slug' => 'php',
                'description' => 'Основы и практика PHP',
            ],
             [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'description' => 'Фреймворк Laravel',
            ],
            [
                'name' => 'Оптимизация',
                'slug' => 'optimization',
                'description' => 'Производительность и качество кода',
            ],
        ];

        $posts = [
             [
                'title' => 'Введение в PHP: с чего начать',
                'content' => 'PHP — это мощный язык для веб-разработки. В этой статье мы рассмотрим основы: переменные, типы данных и простые функции.',
            ],
             [
                'title' => '10 советов по оптимизации кода',
                'content' => 'Узнайте, как улучшить производительность ваших скриптов: от кеширования до правильной работы с базами данных.',
            ],
             [
                'title' => 'Обзор современных фреймворков PHP',
                'content' => 'Сравниваем Laravel, Symfony и Yii. Какой фреймворк выбрать для вашего следующего проекта?',
            ],
             [
                'title' => 'Маршруты и контроллеры в Laravel',
                'content' => 'Разбираем routes/web.php, контроллеры и возврат Blade-шаблонов на простом примере блога.',
            ],
             [
                'title' => 'Массивы и циклы в PHP',
                'content' => 'foreach, ассоциативные массивы и работа с данными без базы — как в учебных моделях Post и Category.',
            ],
        ];

        DB::table('posts')->truncate();
        DB::table('categories')->truncate();


        DB::table('categories')->insert($categories);
        $this->command->info('Категории созданы');

        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        $faker = Factory::create('ru_RU');

        foreach ($posts as $post) {
            $postsData[] = [
                'title' => $post['title'],
               // 'content' => $post['content'],
                'content' => $faker->realText('1500'),
              //  'category_id' => $categoryIds[array_rand($categoryIds)],
                'category_id' => $faker->randomElement($categoryIds),
            ];
        }

        DB::table('posts')->insert($postsData);


        // User::factory(10)->create();

/*        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
