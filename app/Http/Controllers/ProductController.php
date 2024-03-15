<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    public function productsGet()
    {
        try {
            $products = Product::select()->paginate(10);
            if ($products !== null) {
                return response()->json(['products' => $products], 200);
            } else {
                return response()->json(['error' => 'Error. No products'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error getting products: ' . $e->getMessage()], 500);
        }
    }


    public function search(string $text, string $category)
    {
        try {
            
            $categories = Category::where('name', 'LIKE', "%$category%")->pluck('id');

            // Filtra los productos por nombre y por categoría
            $products = Product::where('name', 'LIKE', "%$text%")
                ->whereHas('categories', function ($query) use ($categories) {
                    $query->whereIn('category_id', $categories);
                })->paginate(10);
            return response()->json(['products' => $products], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error getting products: ' . $e->getMessage()], 500);
        }
    }
}
