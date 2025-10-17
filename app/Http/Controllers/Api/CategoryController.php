<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\CategoryStoreRequest;
use App\Http\Requests\Api\Category\CategoryUpdateRequest;
use App\Http\Resources\CategoriesCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
    public function index(): JsonResource
    {
        $categories = Category::paginate(2);

        return CategoriesCollection::make($categories);
    }

    public function store(CategoryStoreRequest $request): JsonResource
    {
        $category = Category::create($request->validated());

        return CategoryResource::make($category);
    }

    public function show(Category $category): JsonResource
    {
        return CategoryResource::make($category);
    }

    public function update(CategoryUpdateRequest $request, Category $category): JsonResource
    {
        $category->update($request->validated());

        return CategoryResource::make($category);
    }

    public function destroy(Category $category): JsonResource
    {
        $category->delete();

        return CategoryResource::make($category);
    }
}
