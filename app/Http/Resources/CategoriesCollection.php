<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoriesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $this->collection->transform(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'posts' => $item->posts->map(function ($post) {
                    return [
                        'name' => $post->name,
                        'slug' => $post->slug,
                        'extract' => $post->extract,
                    ];
                }),
            ];
        });

        return [
            'data' => $data,
        ];
    }
}
