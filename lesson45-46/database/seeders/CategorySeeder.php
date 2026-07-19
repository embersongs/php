<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create('ru_RU');

        $categoryNames = [
            'PHP', 'Laravel', 'JavaScript', 'Python', 'Java',
            'Базы данных', 'DevOps', 'Безопасность', 'Искусственный интеллект',
            'Мобильная разработка'
        ];

        DB::table('posts')->truncate();
        DB::table('categories')->truncate();

        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[] = [
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $faker->sentence(8)
            ];
        }

        DB::table('categories')->insert($categories);
        $this->command->info('Категории созданы');

    }
}
