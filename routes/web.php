<?php

// use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Logincheck;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

// Route::middleware('Logincheck')->group(function () {
    // Route::get('/',[adminController::class,"index"]);

    // admin routes 
    Route::get('/adminhome', [adminController::class,"home"])->name("adminhome");

    Route::get('/adminlogin', [adminController::class,"login"])->name("adminlogin");
    Route::post('/adminlogin', [adminController::class,"loginPost"])->name("adminlogin.post");
    
    Route::get('/adminregister', [adminController::class,"register"])->name("adminregister");
    Route::post('/adminregister', [adminController::class,"registerPost"])->name("adminregister.post");
    
    Route::get('/adminlogout', [adminController::class,"logout"])->name("auth.logout");

    Route::get("/productCreate",[ProductController::class,"productCreate"])->name("productCreate");

    Route::post("/createProduct",[ProductController::class,"createProduct"])->name("product.create");
    
    Route::get("/product/{id}/edit", [ProductController::class,"productEdit"]);

    Route::get("/product/{id}/delete", [ProductController::class,"productDelete"]);

    Route::post("/productUpdate/{id}", [ProductController::class,"productUpdate"])->name("product.update");
    
    Route::get("/adminorders", [ProductController::class,'showOrders'])->name('show.orders');
   
//    user routes 
Route::get('/', [UserController::class,"index"]);

Route::get('/dashboard', [UserController::class,"index"])->name("dashboard");

Route::get('logout',[UserController::class,'logout'])->name('logout');

Route::get("/login", [UserController::class,"login"])->name("login");
Route::post("/login", [UserController::class,"loginPost"])->name("login.post");


Route::get("/register", [UserController::class,"register"])->name("register");

Route::post("/register", [UserController::class,"createUser"])->name("register.post");

Route::get("/profile", [PageController::class,"profile"])->name("profile");
Route::get("/cart", [PageController::class,"cart"])->name("cart");
Route::get("/like", [PageController::class,"like"])->name("like");
Route::get("/orders", [PageController::class,"orders"])->name("orders");




// });
  

