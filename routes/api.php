<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(UserController::class)->group(function () {

    Route::post("/login", "login");

    Route::post("/signup", "signup");

    Route::post("/forgot", "forgot");

    Route::post("/user/edit", "edit");

    Route::post("/user/changePassword", "changePassword");
});

Route::controller(ProductController::class)->group(function () {

    Route::get("/products/get", "productsGet");

    Route::post("/search/{text}/{category}", "search");
});

Route::controller(OrderController::class)->group(function () {

    Route::post("/setOrder", "setOrder");

    Route::get("/history/get", "historyGet");
});

Route::controller(CategoryController::class)->group(function () {


    Route::get("/categories/get", "categoriesGet");
});
