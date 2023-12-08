<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactUsController;
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
Route::post('/register/customer',[CustomerController::class, 'register']);
Route::get('/register/vendor', function () {
    return view('registerVendor');
})->name('register')->middleware('guest');
Route::post('/register/customer',[VendorController::class, 'register']);
Route::get('/vendorList',[VendorController::class, 'index']);


// Route::get('/register/{lang}', function ($lang) {
//     App::setLocale($lang);
//     return view ('register');
// })->name('register')->middleware('guest');

Route::post('/login', [UserController::class, 'login']);
Route::post('/register/customer', [CustomerController::class, 'register']);
Route::post('/register/vendor', [VendorController::class, 'register']);





Route::middleware(['checkauth'])->group(function(){
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


Route::get('/profile/{c:id}',[CustomerController::class, 'viewCustomerProfile']);
Route::put('/editprofile/{c:id}',[CustomerController::class, 'editProfile']);
Route::post('/profile/{c:id}',[CustomerController::class, 'enableEdit']);
Route::get('/editprofpic/{c:id}', [CustomerController::class, 'showEditPict']);
Route::put('/editprofpic/{c:id}', [CustomerController::class, 'editPicture']);
Route::get('/removeprofpic/{c:id}', [CustomerController::class, 'removePicture']);

Route::get('/products/{v:id}',[VendorController::class,'showProductList']);
Route::post('/products/add/{id}', [ProductController::class, 'addToCart']);
