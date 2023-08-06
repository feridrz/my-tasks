<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function getProducts($request)
    {
        $query = Product::with('images');
        $favorites = [];

        if (Auth::check()) {
            $favorites = Auth::user()->favorites()->pluck('product_id')->toArray();
        }

        // Filter
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Sort
        if ($request->has('sort')) {
            $sortParams = explode(',', $request->sort); // for example (category,asc)
            $query->orderBy($sortParams[0], $sortParams[1] ?? 'asc');
        }

        $products = $query->get();

        $products->transform(function ($product) use ($favorites) {
            $product->is_favorite = in_array($product->id, $favorites);
            return $product;
        });

        return $products;
    }

    public function create($data)
    {
        return Product::create($data);
    }
}
