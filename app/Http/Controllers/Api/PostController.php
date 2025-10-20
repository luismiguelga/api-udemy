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
    public function __construct()
    {
        // $this->middleware('auth:api')->except('index', 'show');
    }

    public function index(): JsonResource
    {
        $posts = Post::paginate(3);

        return PostCollection::make($posts);
    }

    public function store(PostStoreRequest $request): JsonResource
    {

        $data = $request->validated();
        dump(auth()->user());
        $data['user_id'] = auth()->user();

        $post = Post::create($data);

        return PostResource::make($post);
    }

    public function show(Post $post): JsonResource
    {
        return PostResource::make($post);
    }

    public function update(PostUpdateRequest $request, Post $post): JsonResource
    {
        $post->update($request->validated());

        return PostResource::make($post);
    }

    public function destroy(Post $post): JsonResource
    {
        $post->delete();

        return PostResource::make($post);
    }
}
