<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrderController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(UserController::class)->group(function(){
    Route::post('login','loginUser');
});
Route::controller(UserController::class)->group(function(){
    Route::get('user','getUserDetails');
    Route::get('logout','userLogout');
    Route::post('cart-items',[CartController::class,'ShowCart'])->name('show_cart');

})->middleware('auth:api');

    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('shop',[HomeController::class,'Shop'])->name('shop');
    Route::get('brand/{slug}',[HomeController::class,'BrandData'])->name('brand');




    //Category apis
    Route::get('category/{slug}',[HomeController::class,'CategoryData'])->name('category');
    Route::get('all-categories',[HomeController::class,'AllCategories']);

    //Product Apis
    Route::get('product/{slug}',[HomeController::class,'ProductDetail'])->name('product_detail');
    Route::get('all-products',[HomeController::class,'Products'])->name('all-products');

    // Cart Apis
    Route::post('add-to-cart',[CartController::class,'AddToCart'])->name('add_to_cart');
    Route::get('delete-item/{id}',[CartController::class,'deleteItem']);
    // Order APis
    Route::post('order-placed',[OrderController::class,'OrderSubmit']);
    Route::post('order-history',[OrderController::class,'OrderHistory']);
    Route::post('orders-detail',[OrderController::class,'ordersDetails']);
    Route::post('order-status',[OrderController::class,'OrderStatus']);
    Route::post('all-orders',[OrderController::class,'allOrderStatus']);


