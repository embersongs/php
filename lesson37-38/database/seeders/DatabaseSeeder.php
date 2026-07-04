<?php

namespace Database\Seeders;

use App\Models\User;
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

        //DB::table('categories')->truncate();
        DB::table('categories')->insert($categories);


        // User::factory(10)->create();

/*        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
