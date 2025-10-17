<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Programación',
                'slug' => 'category-1',
            ],
            [
                'name' => 'Desarrollo Web',
                'slug' => 'category-2',
            ],
            [
                'name' => 'Inteligencia Artificial',
                'slug' => 'category-3',
            ],
            [
                'name' => 'Ciberseguridad',
                'slug' => 'category-4',
            ],
            [
                'name' => 'Base de Datos',
                'slug' => 'category-5',
            ],
            [
                'name' => 'DevOps',
                'slug' => 'category-6',
            ],
            [
                'name' => 'Frameworks',
                'slug' => 'category-7',
            ],
            [
                'name' => 'Noticias Tech',
                'slug' => 'category-8',
            ],

        ];

        foreach ($categories as $key => $category) {
            Category::create($category);
        }
    }
}
