<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use App\Services\FavoriteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    protected $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function index(Request $request)
    {
        $favorites = $this->favoriteService->getUserFavorites($request);
        return $this->successResponse($favorites, '', 200);
    }

    public function store(Product $product)
    {
        $result = $this->favoriteService->addProductToFavorites($product);


        if ($result['code'] === 200) {
            return $this->successResponse([], $result['message'], 200);
        } else {
            return $this->errorResponse($result['message'], [], 400);
        }
    }

    public function destroy(Product $product)
    {
        $result = $this->favoriteService->removeProductFromFavorites($product);
        return $this->successResponse([], $result['message'], $result['code']);
    }

}
