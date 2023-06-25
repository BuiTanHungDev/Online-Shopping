<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Admin Login
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\Admin\LoginController;

// Import các Controller còn lại
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UserController;

// Route đăng nhập Admin
Route::post('/admin/login', [LoginController::class, 'login']);

// Route Admin Dashboard
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');

    // Route Banner section
    Route::resource('/banner', BannerController::class);
    Route::post('/banner/status', [BannerController::class, 'bannerStatus'])->name('banner.status');

    // Route Category section
    Route::resource('/category', CategoryController::class);
    Route::post('/category/status', [CategoryController::class, 'categoryStatus'])->name('category.status');
    Route::post('/category/{id}/child', [CategoryController::class, 'getChildParentID']);

    // Route Brand section
    Route::resource('/brand', BrandController::class);
    Route::post('/brand/status', [BrandController::class, 'brandStatus'])->name('brand.status');

    // Route Product section
    Route::resource('/product', ProductController::class);
    Route::post('/product/status', [ProductController::class, 'productStatus'])->name('product.status');
    Route::post('/product-attribute/{id}', [ProductController::class, 'addProductAttribute'])->name('product.attribute');
    Route::delete('/product-attribute-delete/{id}', [ProductController::class, 'addProductAttributeDelete'])->name('product.attribute.destroy');

    // Route User section
    Route::resource('/user', UserController::class);
    Route::post('/user/status', [UserController::class, 'userStatus'])->name('user.status');

    // Route Coupon section
    Route::resource('/coupon', CouponController::class);
    Route::post('/coupon/status', [CouponController::class, 'couponStatus'])->name('coupon.status');

    // Route Shipping section
    Route::resource('/shipping', ShippingController::class);
    Route::post('/shipping/status', [ShippingController::class, 'shippingStatus'])->name('shipping.status');

    // Route Currency section
    Route::resource('/currency', CurrencyController::class);
    Route::post('/currency/status', [CurrencyController::class, 'currencyStatus'])->name('currency.status');

    // Route Order section
    Route::resource('/order', OrderController::class);
    Route::post('/order/status', [OrderController::class, 'orderStatus'])->name('order.status');

    // Route Settings section
    Route::get('/settings', [SettingsController::class, 'Settings'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'SettingsUpdate'])->name('settings.store');

    // Route Seller section
    Route::resource('/seller', SellerController::class);
    Route::post('/seller/status', [SellerController::class, 'sellerStatus'])->name('seller.status');
    Route::post('/seller/verified', [SellerController::class, 'sellerVerified'])->name('seller.verified');
});

// Route Laravel Filemanager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Route API cho các chức năng khác
Route::group(['prefix' => 'api'], function () {
    // Route API cho Frontend Cart
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::post('/cart/update', [CartController::class, 'update']);
    Route::post('/cart/remove', [CartController::class, 'remove']);
    // Thêm các route khác cho Frontend Cart

    // Route API cho Frontend Checkout
    Route::post('/checkout', [CheckoutController::class, 'checkout']);
    // Thêm các route khác cho Frontend Checkout

    // Route API cho Frontend Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index']);
    Route::post('/wishlist/add', [WishlistController::class, 'add']);
    Route::post('/wishlist/remove', [WishlistController::class, 'remove']);
    // Thêm các route khác cho Frontend Wishlist

    // Route API cho Frontend Index
    Route::get('/index', [IndexController::class, 'index']);
    // Thêm các route khác cho Frontend Index

    // Route API cho Product Review
    Route::post('/product/review', [ProductReviewController::class, 'store']);
    // Thêm các route khác cho Product Review
});

