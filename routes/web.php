<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function(){
    return view('homepage');
});
Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');
Route::post('/login',[UserController::class, 'login']);
Route::get('/register/customer', function () {
    return view('register');
})->name('register')->middleware('guest');
Route::get('/register/vendor', function () {
    return view('registerVendor');
})->name('register')->middleware('guest');
Route::get('/vendorList',[VendorController::class, 'index']);


// Route::get('/register/{lang}', function ($lang) {
//     App::setLocale($lang);
//     return view ('register');
// })->name('register')->middleware('guest');


Route::middleware(['auth'])->group(function(){
    Route::middleware(['admin'])->group(function(){
        Route::get('/accountMaintain', [AccountController::class, 'accountMaintain']);
        Route::get('/changeRole/{id}', [AccountController::class, 'changeRole']);
    }); 
    Route::middleware(['customer'])->group(function(){
        Route::get('/orderlist/{c:id}',[OrderController::class, 'viewOrderList']);
        Route::post('/editstatus/{o:id}', [OrderController::class, 'editStatus']);
        // Route::get('/orderList/{id}',[OrderController::class, 'viewOrderList']);
        Route::get('/checkout',[ProductController::class, 'cartIndex']);
    }); 
    Route::middleware(['vendor'])->group(function(){
        Route::get('/orderlist/{c:id}',[OrderController::class, 'viewOrderList']);
        Route::post('/editstatus/{o:id}', [OrderController::class, 'editStatus']);
        Route::get('/addProduct', function () {
            return view('addProduct');
        });
        Route::post('/addProduct', [ProductController::class, 'insertProduct']);
        Route::get('/orderList/{id}',[OrderController::class, 'viewOrderList']);
    }); 
});

