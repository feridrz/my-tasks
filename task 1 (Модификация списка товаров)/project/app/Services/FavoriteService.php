<?php

namespace App\Services;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteService
{
    public function getUserFavorites(Request $request)
    {
        $query = Favorite::where('user_id', Auth::id())->with(['product' => function ($query) use ($request) {
            if ($request->has('category')) {
                $query->where('category', $request->category);
            }

            if ($request->has('sort')) {
                $sortParams = explode(',', $request->sort);
                $query->orderBy($sortParams[0], $sortParams[1] ?? 'asc');
            }
        }, 'product.images']);

        return $query->get()->map(function ($favorite) {
            if ($favorite->product !== null) {
                return [
                    'id' => $favorite->id,
                    'user_id' => $favorite->user_id,
                    'product' => $favorite->product
                ];
            }
        })->filter()->values();
    }

    public function addProductToFavorites(Product $product)
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($favorite) {
            return [
                'message' => 'Product already in favorites',
                'code' => 400
            ];
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);

            return [
                'message' => 'Product added to favorites',
                'code' => 200
            ];
        }
    }

    public function removeProductFromFavorites(Product $product)
    {
        Favorite::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->delete();

        return [
            'message' => 'Product removed from favorites',
            'code' => 200
        ];
    }
}
