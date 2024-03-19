<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 帳號權限相關
Route::group(
    ['prefix' => 'auth'],
    function () {
        /**
         * 註冊
         *
         * @link api/auth/register
         */
        Route::post('/register', [AuthController::class, 'register'])->name('api.auth.register');

        /**
         * 登入
         *
         * @link api/auth/login
         */
        Route::post('/login', [AuthController::class, 'login'])->name('api.auth.login');

        /**
         * 登出
         *
         * @link api/auth/logout
         */
        Route::post('/logout', [AuthController::class, 'logout'])->name('api.auth.logout');
    }
);

// 使用者相關
Route::group(
    ['prefix' => 'user'],
    function () {
        /**
         * 使用者基本資料
         *
         * @link api/user/info
         */
        Route::get('/info', [UserController::class, 'info'])->name('api.user.info');

        /**
         * 使用者合作邀請
         *
         * @link api/user/contact
         */
        Route::get('/contact', [UserController::class, 'contact'])->name('api.user.contact');
    }
);

// 產品相關
Route::group(
    ['prefix' => 'product'],
    function () {
        /**
         * 新增
         *
         * @link api/product/create
         */
        Route::get('/create', [ProductController::class, 'createProduct'])->name('api.product.create');
        
        /**
         * 查詢產品種類
         *
         * @link api/product/search
         */
        Route::get('/search', [ProductController::class, 'getProduct'])->name('api.product.search');    

        /**
         * 結帳
         *
         * @link api/product/checkout
         */
        Route::post('/checkout', [ProductController::class, 'checkout'])->name('api.product.checkout');    

        /**
         * 訂單資訊
         *
         * @link api/product/orderList
         */
        Route::get('/orderList', [ProductController::class, 'orderList'])->name('api.product.orderList');    
    
    }
);