<?php

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

// 首頁
Route::get('/', function () {
    return view('index');
})->name('home');

// 登入 / 註冊
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// 產品列表
Route::get('/product', function () {
    return view('product');
})->name('product');

// 產品列表
Route::get('/logout', function () {
    return view('logout');
})->name('logout');

// 會員資料
Route::get('/member', function () {
    return view('member');
})->name('member');

// 商業合作
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// 咖啡介紹
Route::get('/coffee', function () {
    return view('coffee');
})->name('coffee');

// 結帳
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');