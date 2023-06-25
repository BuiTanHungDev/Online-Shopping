<?php

//Authentication


use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('user/auth',[IndexController::class,'userAuth'])->name('user.auth');
Route::post('user/login', [IndexController::class,'loginSubmmit'])->name('login.submit');
Route::post('user/register', [IndexController::class,'registerSubmmit'])->name('register.submit');
Route::get('user/logout', [IndexController::class,'userLogout'])->name('user.logout');


//Authentication
Route::get('/',[IndexController::class,'home'])->name('home');
//ProducCategory
Route::get('product-category/{slug}/',[IndexController::class,'productCategory'])->name('product.category');
// Product Detail
Route::get('product-detail/{slug}/',[IndexController::class,'productDetail'])->name('product.detail');
// Section  Product review
Route::post('product-review/{slug}',[ProductReviewController::class,'productReview'])->name('product.review');

// Cart Section
Route::get('cart',[CartController::class,'cart'])->name('cart');
Route::post('cart/store',[CartController::class,'cartStore'])->name('cart.store');
Route::post('cart/delete',[CartController::class,'cartDelete'])->name('cart.delete');
Route::post('cart/update',[CartController::class,'cartUpdate'])->name('cart.update');

// Coupon Section
Route::post('coupon-add',[CartController::class,'addCoupon'])->name('coupon.add');



// wishlist
Route::get('wishlist',[WishlistController::class,'wishlist'])->name('wishlist');
Route::post('wishlist/store',[WishlistController::class,'wishlistStore'])->name('wishlist.store');
Route::post('wishlist/moving-to-cart',[WishlistController::class,'moveToCart'])->name('wishlist.move.cart');
Route::post('wishlist/delete-wishlist',[WishlistController::class,'deleteWishlist'])->name('wishlist.delete');

// checkout section
Route::match(['get','post'],'checkout1',[CheckoutController::class,'checkout1'])->name('checkout1')->middleware('user');
Route::post('checkout-first',[CheckoutController::class,'checkout1Store'])->name('checkout1.store');
Route::post('checkout-two',[CheckoutController::class,'checkout2Store'])->name('checkout2.store');
Route::post('checkout-three',[CheckoutController::class,'checkout3Store'])->name('checkout3.store');
Route::get('checkout-store',[CheckoutController::class,'checkoutStore'])->name('checkout.store');
Route::get('checkout-complete/{order}',[CheckoutController::class,'checkoutComplete'])->name('checkout.complete');

//Shop section

Route::get('shop',[IndexController::class,'shop'])->name('shop');

Route::post('shop-filter',[IndexController::class,'shopFilter'])->name('shop.filter');

//Search Product & Autosearch product

Route::get('autoSearch',[IndexController::class,'autoSearch'])->name('autoSearch');
Route::get('search',[IndexController::class,'Search'])->name('search');

// Section 


Auth::routes(['register'=> false]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);


// User Dashboard

Route::group(['prefix'=>'user'],function () {
    Route::get('/dashboard', [IndexController::class,'userDashboard'])->name('user.dashboard');
    Route::get('/order', [IndexController::class,'userOrder'])->name('user.order');
    Route::get('/address', [IndexController::class,'userAddress'])->name('user.address');
    Route::get('/account', [IndexController::class,'userAccount'])->name('user.account');

    // 
    Route::post('/billing/address/{id}',[IndexController::class,'billingAddress'])->name('billing.address');
    Route::post('/shipping/address/{id}',[IndexController::class,'shippingAddress'])->name('shipping.address');
    //
    Route::post('update/account/{id}',[IndexController::class,'updateAccount'])->name('update.account');

    
});