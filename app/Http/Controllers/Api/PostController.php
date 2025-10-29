<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Post\PostStoreRequest;
use App\Http\Requests\Api\Post\PostUpdateRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Utilities\Response;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = Post::paginate(3);

        return Response::make(data: PostCollection::make($posts));
    }

    public function store(PostStoreRequest $request): JsonResponse
    {

        $data = $request->validated();

        $data['user_id'] = auth()->user()->id;

        $post = Post::create($data);

        return Response::make(data: PostResource::make($post));
    }

    public function show(Post $post): JsonResponse
    {
        return Response::make(data: PostResource::make($post));
    }

    public function update(PostUpdateRequest $request, Post $post): JsonResponse
    {
        $this->authorize('update', $post);

        $post->update($request->validated());

        return Response::make(data: PostResource::make($post));
    }

    public function destroy(Post $post): JsonResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        return Response::make(data: PostResource::make($post));
    }
}
