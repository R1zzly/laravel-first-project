<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('authorize')->group(function () {
    Route::get('/verify', [AuthController::class, 'verify'])->name('verify');
    Route::post('/verify/email', [AuthController::class, 'emailVerification'])->name('verify.email');

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index')->middleware('can:show category');
    Route::get('/category/create',[CategoryController::class,'create'])->name('category.create')->middleware('can:create category');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store')->middleware('can:create category');
    Route::get('/category/products/{id}', [CategoryController::class, 'show'])->name('category.products')->middleware('can:show category');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('can:update category');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware('can:update category');
    Route::delete('/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('can:delete category');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::post('/product/reviews/{products}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::patch('/cart/{cartItem}/increase', [CartController::class, 'increaseQuantity'])->name('cart.increase');
    Route::patch('/cart/{cartItem}/decrease', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');

    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');

//    Route::get('/messages', [MessageController::class, 'messages'])->name('messages');
//    Route::post('/message', [MessageController::class, 'message'])->name('message');

    Route::get('subscribe', [SubscriptionController::class, 'show']);
    Route::post('subscribe', [SubscriptionController::class, 'store']);

    Route::resource('roles', RoleController::class)->middleware(RoleMiddleware::class.':super-user');
    Route::resource('users', UserController::class)->middleware(RoleMiddleware::class.':super-user');
});

Route::middleware('guest')->group(function () {
    Route::get('/register',[AuthController::class,'create'])->name('register.create');
    Route::post('/register/store',[AuthController::class,'store'])->name('register.store');

    Route::get('/login',[AuthController::class,'logindex'])->name('logindex');
    Route::post('/login/create',[AuthController::class,'login'])->name('logincreate');

    Route::get('/forgot',[AuthController::class,'forgotPasswordIndex'])->name('forgotpasswordindex');
    Route::post('/forgot/enter',[AuthController::class,'forgotPassword'])->name('forgot.password');
    Route::get('/match',[AuthController::class,'match'])->name('password.match');
    Route::post('/matchete',[AuthController::class,'matchete'])->name('password.matchete');
});




