<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Services\ImageService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->getProducts($request);
        return $this->successResponse($products);
    }

    public function show(Product $product)
    {
        $product = Product::with('images')->find($product->id);

        return $this->successResponse($product);
    }

    public function store(ProductStoreRequest $request, ProductService $productService, ImageService $imageService)
    {
        $product = $productService->create($request->validated());

        $images = $imageService->storeImages($request->file('images'));
        $product->images()->createMany($images);

        $product->load('images');

        return $this->successResponse($product,'', 201);
    }

}
