<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
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
                'name' => $item->name,
                'slug' => $item->slug,
                'extract' => $item->extract,
                'body' => $item->body,
                'status' => $item->status,
                'category' => [
                    'name' => $item->category?->name,
                    'slug' => $item->category?->slug,
                ],
            ];
        });

        return [
            'data' => $data,
        ];
    }
}
