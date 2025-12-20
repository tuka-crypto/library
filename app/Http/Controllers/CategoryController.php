<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Helpers\ResponseHelper;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::withcount('books')->get();
        return ResponseHelper::success(CategoryResource::collection($categories),'all categories');
    }
    public function store(StoreCategoryRequest $request)
    {
        $category=Category::create($request->validated());
        return ResponseHelper::success(new CategoryResource($category),'added category successfully');
    }
    public function show(Category $category)
    {
        return ResponseHelper::success(new CategoryResource($category),'category details');
    }
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return ResponseHelper::success(new CategoryResource($category),'updated category successfully');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return ResponseHelper::success('deleted category successfully');
    }
}
