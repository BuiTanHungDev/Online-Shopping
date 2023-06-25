<?php

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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ .'/frontend.php';
require __DIR__ .'/backend.php';
require __DIR__ .'/seller.php';


Route::post('currency_load',[CurrencyController::class,'currencyLoad'])->name('currency.load');


// ------------------------------------------------------------------------------------------


Auth::routes(['register'=>false]);
