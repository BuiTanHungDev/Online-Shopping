<?php

use App\Http\Controllers\Auth\Seller\AuthController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'seller'], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('seller.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('seller.login');
});

// Seller Dashboard

Route::group(['prefix'=>'seller','middleware'=>['seller']],function () {
 
    Route::get('/',[SellerController::class,'dashboard'])->name('seller');
   //Product section
   Route::resource('/seller-product', ProductController::class);
   Route::post('seller_product_status',[ProductController::class,'productStatus'])->name('seller.product.status');

   
});
// End Admin Section


Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});