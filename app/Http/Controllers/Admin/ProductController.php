<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\BaseCategory;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    private $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->middleware('auth:admin');
        $this->productRepository = $productRepository;
    }

    // public function store(StoreProductRequest $request)
    // {

    //     $product = $this->productRepository->store($request->validated());
    //     return response()->json("Item created successfully with id : $product->id");
    // }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        $product = $this->productRepository->store($validatedData);
        return response()->json("Item created successfully with id : $product->id",$product);
    }


    public function update(UpdateProductRequest $request)
    {
        $product = $this->productRepository->update($request->validated());
        return response()->json("Item with id : $product->id updated successfully");
    }

    public function delete($id)
    {
        $product = $this->productRepository->delete($id);
        return response()->json("Item with id : $product->id deleted successfully");
    }

    public function index()
    {
        $text = isset(request()->text) ? request()->text : '';
        return $this->productRepository->getProducts(
            $text,
            request()->page_size,
            request()->category_id,
            request()->status
        );
    }
    public function getCategories()
    {
        return $this->productRepository->getCategories();
    }
    public function find($id)
    {
        return $this->productRepository->getProduct($id);
    }
    public function Products()
    {
        $products = Product::all();
        return response()->json($products);
    }
    // public function getPrice($productId)
    // {
    //     $product = Product::findOrFail($productId);
    //     return response()->json(['price' => $product->price]);
    // }




}
