<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBaseCategoryRequest;
use App\Http\Requests\Admin\UpdateBaseCategoryRequest;
use App\Repositories\BaseCategoryRepository;

class BaseCategoryController extends Controller
{
    private $baseCategoryRepository;
    public function __construct(BaseCategoryRepository $baseCategoryRepository)
    {
        $this->middleware('auth:admin');
        $this->baseCategoryRepository = $baseCategoryRepository;
    }

    public function store(StoreBaseCategoryRequest $request)
    {
        $brand = $this->baseCategoryRepository->store($request->validated());
        return response()->json("Item created successfully with id : $brand->id");
    }

    public function update(UpdateBaseCategoryRequest $request)
    {
        $brand = $this->baseCategoryRepository->update($request->validated());
        return response()->json("Item with id : $brand->id updated successfully");
    }

    public function delete($id)
    {
        $brand = $this->baseCategoryRepository->delete($id);
        return response()->json("Item with id : $brand->id deleted successfully");
    }

    public function index()
    {
        $text = isset(request()->text) ? request()->text : '';
        return $this->baseCategoryRepository->getCategories($text, request()->page_size, request()->status);
    }
    public function toggleStatus($id)
    {
        $brand = $this->baseCategoryRepository->toggleStatus($id);
        return response()->json("Status of item with id : $brand->id updated successfully");
    }
    public function find($id)
    {
        return $this->baseCategoryRepository->getCategory($id);
    }
}
