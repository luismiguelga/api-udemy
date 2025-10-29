<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\CategoryStoreRequest;
use App\Http\Requests\Api\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoriesCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Utilities\Response;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::paginate(2);

        return Response::make(data: CategoriesCollection::make($categories));
    }

    public function store(CategoryStoreRequest $request): JsonResponse
    {
        $category = Category::create($request->validated());

        return Response::make(data: CategoryResource::make($category));
    }

    public function show(Category $category): JsonResponse
    {
        return Response::make(data: CategoryResource::make($category));
    }

    public function update(CategoryUpdateRequest $request, Category $category): JsonResponse
    {
        $category->update($request->validated());

        return Response::make(data: CategoryResource::make($category));
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return Response::make(data: CategoryResource::make($category));
    }
}
