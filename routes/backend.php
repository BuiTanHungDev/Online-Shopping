<?php


// Admin Login


use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin'],function(){
    Route::get('/login',[LoginController::class,'showLoginForm'])->name('admin.login.form');
    Route::post('/login',[LoginController::class,'login'])->name('admin.login');

});    
// Admin Dashboard

Route::group(['prefix'=>'admin','middleware'=>['admin']],function () {
    Route::get('/',[AdminController::class,'admin'])->name('admin');

    //Banner section
    Route::resource('/banner', BannerController::class);
    Route::post('banner_status',[ BannerController::class,'bannerStatus'])->name('banner.status');
    //Category section
    Route::resource('/category', CategoryController::class);
    Route::post('category_status',[ CategoryController::class,'categoryStatus'])->name('category.status');

    Route::post('category/{id}/child', [CategoryController::class,'getChildParentID']);
        
  
    //Brand section
    Route::resource('/brand', BrandController::class);
    Route::post('brand_status',[BrandController::class,'brandStatus'])->name('brand.status');
    //Product section
    Route::resource('/product', ProductController::class);
    Route::post('product_status',[ProductController::class,'productStatus'])->name('product.status');
    // product attribute Section
    Route::post('product-attribute/{id}',[ProductController::class,'addProductAttribute'])->name('product.attribute');
    Route::delete('product-attribute-delete/{id}',[ProductController::class,'addProductAttributeDelete'])->name('product.attribute.destroy');


    //User section
    Route::resource('/user', UserController::class);
    Route::post('user_status',[UserController::class,'userStatus'])->name('user.status');

    //Coupon section
    Route::resource('/coupon', CouponController::class);
    Route::post('coupon_status',[CouponController::class,'couponStatus'])->name('coupon.status');

    //Shipping section
    Route::resource('/shipping', ShippingController::class);
    Route::post('shipping_status',[ShippingController::class,'shippingStatus'])->name('shipping.status');

    // Currency Section
    Route::resource('/currency',CurrencyController::class);
    Route::post('currency-status',[CurrencyController::class,'currencyStatus'])->name('currency.status');


    //Order Section
    Route::resource('/order', OrderController::class);
    Route::post('order-status',[OrderController::class,'orderStatus'])->name('order.status');

    // Settings Section
    Route::get('settings',[SettingsController::class,'Settings'])->name('settings');
    Route::put('settings',[SettingsController::class,'SettingsUpdate'])->name('settings.store');

      //Order Section
      Route::resource('/seller', SellerController::class);
      Route::post('seller-status',[SellerController::class,'sellerStatus'])->name('seller.status');
      Route::post('seller-verified',[SellerController::class,'sellerVerified'])->name('seller.verified');


});
// End Admin Section
// Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});