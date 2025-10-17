<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'Laravel',
                'slug' => 'tag-1',
            ],
            [
                'name' => 'React',
                'slug' => 'tag-2',
            ],
            [
                'name' => 'Vue.js',
                'slug' => 'tag-3',
            ],
            [
                'name' => 'Node.js',
                'slug' => 'tag-4',
            ],
            [
                'name' => 'Python',
                'slug' => 'tag-5',
            ],
            [
                'name' => 'Django',
                'slug' => 'tag-6',
            ],
            [
                'name' => 'Flask',
                'slug' => 'tag-7',
            ],
            [
                'name' => 'Docker',
                'slug' => 'tag-8',
            ],
            [
                'name' => 'Kubernetes',
                'slug' => 'tag-9',
            ],
            [
                'name' => 'PostgreSQL',
                'slug' => 'tag-10',
            ],
        ];

        foreach ($tags as $key => $tag) {
            Tag::create($tag);
        }
    }
}
