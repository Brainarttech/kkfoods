<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;







use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

    // Route::get('/',[HomeController::class,'index'])->name('home');
    // Route::view('repairing-services','front-app.repairing_services')->name('repairing');
    // Route::get('shop',[HomeController::class,'Shop'])->name('shop');
    // Route::view('about','front-app.about')->name('about');
    // Route::view('terms-conditions','front-app.terms_conditions')->name('terms_conditions');
    // Route::get('product-detail/{id}',[HomeController::class,'ProductDetail'])->name('product_detail');
    // Route::get('brand/{slug}',[HomeController::class,'BrandData'])->name('brand');
    // Route::get('category/{slug}',[HomeController::class,'CategoryData'])->name('category');
    // Route::get('product/{slug}',[HomeController::class,'ProductDetail'])->name('product_detail');
    // Route::get('cart',[CartController::class,'ShowCart'])->name('show_cart');
    // Route::post('add-to-cart',[CartController::class,'AddToCart'])->name('add_to_cart');
    // Route::get('delete-item/{id}',[CartController::class,'DeleteItem'])->name('delete-item');
    // Route::post('checkout',[CartController::class,'checkout'])->name('checkout');
    Route::get('/dashboard',[HomeController::class,'DashboardData'])->name('dashboard')->middleware(['auth', 'verified']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// backend app

//products
Route::get('products',[ProductController::class,'index'])->name('products');
Route::view('add-products','backend_app.addproduct')->name('addproduct');
Route::post('submit-product',[ProductController::class,'store'])->name('submitproduct');
Route::get('edit-product/{id}',[ProductController::class,'edit'])->name('edit-product');
Route::post('update-product/{id}',[ProductController::class,'update'])->name('updateproduct');
Route::get('delete-product/{id}',[ProductController::class,'destroy'])->name('delete-product');
Route::get('show-product',[ProductController::class,'index'])->name('showproduct');
Route::get('delete-img/{id}',[ProductController::class,'ImgDel'])->name('delete-img');
Route::post('/upload', 'UploadController@upload')->name('upload');



//Categoires

Route::get('categories',[CategoryController::class,'index'])->name('show-category');
Route::view('add-category','backend_app.addcategory')->name('add-category');
Route::post('submit-category',[CategoryController::class,'create'])->name('submit-category');
Route::get('edit-category/{id}',[CategoryController::class,'edit'])->name('edit-category');
Route::post('update-category/{id}',[CategoryController::class,'update'])->name('update-category');
Route::get('destroy-category/{id}',[CategoryController::class,'destroy'])->name('destroy-category');


//Brands
Route::get('brands',[BrandController::class,'index'])->name('show-brands');
Route::view('add-brand','backend_app.addbrand')->name('add-brand');
Route::post('submit-brand',[BrandController::class,'store'])->name('submit-brand');
Route::get('edit-brand/{id}',[BrandController::class,'edit'])->name('edit-brand');
Route::post('update-brand/{id}',[BrandController::class,'update'])->name('update-brand');
Route::get('destroy-brand/{id}',[BrandController::class,'destroy'])->name('destroy-brand');


//Orders
Route::get('all-orders',[OrderController::class,'allOrders'])->name('orders');
Route::get('delete-order/{id}',[OrderController::class,'deleteOrder'])->name('deleteOrder');
Route::post('update-order',[OrderController::class,'updateStatus'])->name('update-status');
Route::get('pending-orders',[OrderController::class,'PendingOrder'])->name('pending-order');
Route::get('delivered-orders',[OrderController::class,'DeliveredOrder'])->name('delivered-order');
Route::get('return-orders',[OrderController::class,'ReturnOrder'])->name('return-order');
Route::get('order-detail/{id}',[OrderController::class,'OrderDetail'])->name('order-detail');


// Slider




// Setting

Route::view('generalsetting','backend_app.generalsetting')->name('generalsetting');
Route::view('mails','backend_app.mails')->name('mails');


// Users

Route::get('allusers',[UserController::class,'allUsers'])->name('all-users');
Route::view('add-user','backend_app.add_user')->name('add_user');
Route::post('submit-user',[UserController::class,'submitUser'])->name('submit-user');
Route::get('check-user/{id}',[UserController::class,'editUser'])->name('edit-user');
Route::post('update-user/{id}',[UserController::class,'updateUser'])->name('update-user');


//order filter

Route::post('order-filter',[OrderController::class,'OrderFilter'])->name("order-filter");

//Summary
Route::get('summary',[OrderController::class,'Usersummary'])->name('summary');
Route::post('summary-filter',[OrderController::class,'SummaryFilter'])->name('summary-filter');

//Print out
Route::get('print',[OrderController::class,'printOut'])->name('print-out');
