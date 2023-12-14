<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PromotionController;
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


Route::get('/',[VendorController::class, 'indexHomepage']);
Route::get('/homepage',[VendorController::class, 'indexHomepage']);
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
Route::post('/register/vendor',[VendorController::class, 'register']);
Route::get('/vendorList',[VendorController::class, 'index']);
Route::get('/vendorList/search', [VendorController::class, 'search'])->name('vendor.search');


// Route::get('/register/{lang}', function ($lang) {
//     App::setLocale($lang);
//     return view ('register');
// })->name('register')->middleware('guest');

Route::post('/login', [UserController::class, 'login']);
Route::post('/register/customer', [CustomerController::class, 'register']);
Route::post('/register/vendor', [VendorController::class, 'register']);


Route::middleware(['checkauth'])->group(function(){
    Route::get('/orderlist',[OrderController::class, 'viewOrderList']);
    Route::get('/cancelmembership',[MembershipController::class, 'viewCancelMembership']);
    Route::get('/registermembership',[MembershipController::class, 'ViewRegisterMembership']);
    Route::middleware(['admin'])->group(function(){       
    }); 
    Route::middleware(['checkCustOrVend'])->group(function(){
        Route::get('/orderlist/{c:id}',[OrderController::class, 'viewOrderList']);       
    }); 
    Route::middleware(['customer'])->group(function(){
        Route::post('/editstatus/{o:id}', [OrderController::class, 'editStatus']);
        Route::post('/checkout',[OrderController::class, 'checkout']);
        Route::post('/minQuantity/{id}',[ProductController::class, 'decreaseQuantity']);
        Route::post('/addQuantity/{id}',[ProductController::class, 'addQuantity']);
        Route::get('/products/{v:id}',[VendorController::class,'showProductList']);
        Route::post('/products/add/{id}', [ProductController::class, 'addToCart']);
        Route::get('/products/search/{v:id}', [ProductController::class, 'search'])->name('products.search');
        Route::get('/checkout',[ProductController::class, 'cartIndex']);
        Route::delete('/checkout/{id}',[ProductController::class, 'deleteItem']);
        Route::get('/customer/profile',[CustomerController::class, 'viewCustomerProfile']);
        Route::put('/customer/editprofile',[CustomerController::class, 'editProfile']);
        Route::post('/customer/profile',[CustomerController::class, 'enableEdit']);
        Route::get('/customer/editprofpic', [CustomerController::class, 'showEditPict']);
        Route::put('/customer/editprofpic', [CustomerController::class, 'editPicture']);
        Route::get('/customer/removeprofpic', [CustomerController::class, 'removePicture']);
        Route::post('/customer/registermembership', [CustomerController::class, 'registerMembership']);
        Route::post('/customer/cancelmembership', [CustomerController::class, 'cancelMembership']);
        Route::get('/finishorder/{o:id}', [OrderController::class, 'finishOrder']);
        Route::post('/addreview/{o:id}', [ReviewController::class, 'addReview']);
    }); 

    Route::middleware(['vendor'])->group(function(){
        Route::post('/editstatus/{o:id}', [OrderController::class, 'editStatus']);
        Route::get('/addProduct', function () {
            return view('addProduct');
        });
        Route::get('/editProduct/{id}',[ProductController::class, 'editIndex']);
        Route::post('/addProduct', [ProductController::class, 'insertProduct']);
        Route::get('/vendor/profile',[VendorController::class, 'viewVendorProfile']);
        Route::put('/vendor/editprofile',[VendorController::class, 'editProfile']);
        Route::post('/vendor/profile',[VendorController::class, 'enableEdit']);
        Route::get('/vendor/editprofpic', [VendorController::class, 'showEditPict']);
        Route::put('/vendor/editprofpic', [VendorController::class, 'editPicture']);
        Route::get('/vendor/removeprofpic', [VendorController::class, 'removePicture']);
        Route::get('/registermembership/products', [MembershipController::class, 'showVendorProducts']);
        Route::post('/vendor/registermembership', [VendorController::class, 'registerMembership']);
        Route::post('/vendor/cancelmembership', [VendorController::class, 'cancelMembership']);
        Route::get('/promotion/create/{p:id}', [PromotionController::class, 'viewCreatePromotion']);
        Route::post('/promotion/add/{p:id}', [PromotionController::class, 'addPromotion']);
        
    });
     Route::get('/logout', [UserController::class, 'logout']);
});
Route::get('/products/{v:id}',[VendorController::class,'showProductList']);
Route::post('/products/add/{id}', [ProductController::class, 'addToCart']);
Route::get('/products/search/{v:id}', [ProductController::class, 'search'])->name('products.search');
