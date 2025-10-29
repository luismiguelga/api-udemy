<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\PostStoreRequest;
use App\Http\Requests\Api\Post\PostUpdateRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostController extends Controller
{
    public function index(): JsonResource
    {
        $posts = Post::paginate(3);

        return PostCollection::make($posts);
    }

    public function store(PostStoreRequest $request): JsonResource
    {

        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        $post = Post::create($data);

        return PostResource::make($post);
    }

    public function show(Post $post): JsonResource
    {
        return PostResource::make($post);
    }

    public function update(PostUpdateRequest $request, Post $post): JsonResource
    {
        $this->authorize('update', $post);

        $post->update($request->validated());

        return PostResource::make($post);
    }

    public function destroy(Post $post): JsonResource
    {
        $this->authorize('delete', $post);

        $post->delete();

        return PostResource::make($post);
    }
}
