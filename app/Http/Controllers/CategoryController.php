<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categoriesGet(){
        try{
            $categories = Category::all();
            if($categories!=null){
                return response()->json(['categories'=>$categories],200);
            } else{
                return response()->json(['error' => 'Error. No categories'], 400);
            }
        }catch(\Exception $e){
            return response()->json(['error' => 'Error getting categories: ' . $e->getMessage()], 500);
        }
    }
}
