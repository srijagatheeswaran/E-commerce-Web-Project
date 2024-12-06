<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ProductControler;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Logincheck;

// Route::middleware('Logincheck')->group(function () {
    Route::get('/',[AuthManager::class,"index"]);
    Route::get('/home', [AuthManager::class,"home"])->name("home");

    Route::get('/login', [AuthManager::class,"login"])->name("login");
    Route::post('/login', [AuthManager::class,"loginPost"])->name("login.post");
    
    Route::get('/register', [AuthManager::class,"register"])->name("register");
    Route::post('/register', [AuthManager::class,"registerPost"])->name("register.post");
    
    Route::get('/logout', [AuthManager::class,"logout"])->name("auth.logout");

    Route::get("/productCreate",[ProductControler::class,"productCreate"])->name("productCreate");

    Route::post("/createProduct",[ProductControler::class,"createProduct"])->name("product.create");
    
    Route::get("/product/{id}/edit", [ProductControler::class,"productEdit"]);

    Route::get("/product/{id}/delete", [ProductControler::class,"productDelete"]);

    Route::post("/productUpdate/{id}", [ProductControler::class,"productUpdate"])->name("product.update");

    Route::get("/orders", [ProductControler::class,'showOrders'])->name('show.orders');
// });
  

