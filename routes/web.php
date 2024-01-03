<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\VendorProfileController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\VendorMembershipController;
use App\Http\Controllers\CustomerMembershipController;
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


// Route::get('/register/{lang}', function ($lang) {
//     App::setLocale($lang);
//     return view ('register');
// })->name('register')->middleware('guest');

Route::post('/login', [UserController::class, 'login']);
Route::post('/register/customer', [CustomerController::class, 'register']);
Route::post('/register/vendor', [VendorController::class, 'register']);

Route::middleware(['checkIfAdmin','checkIfVendor'])->group(function(){
    Route::get('/products/{v:id}',[VendorController::class,'showProductList']);
    Route::get('/vendorList',[VendorController::class, 'index']);
    Route::get('/vendorList/search', [VendorController::class, 'search'])->name('vendor.search');
    Route::get('/',[VendorController::class, 'indexHomepage']);
    Route::get('/homepage',[VendorController::class, 'indexHomepage']);
});

Route::middleware(['checkauth'])->group(function(){
    Route::get('/cancelmembership',[MembershipController::class, 'viewCancelMembership']);
    Route::get('/registermembership',[MembershipController::class, 'ViewRegisterMembership']);
    Route::middleware(['admin'])->group(function(){
        Route::get('/manageUser',[AdminController::class, 'index']);
        Route::put('/activate/{id}',[AdminController::class, 'activateUser']);
        Route::put('/deactivate/{id}',[AdminController::class, 'deActivateUser']);
    });
    Route::middleware(['checkCustOrVend'])->group(function(){
        Route::get('/orderlist',[OrderController::class, 'viewOrderList']);
        Route::get('/orderdetail/{id}', [OrderDetailController::class, 'index']);
        Route::get('/products/search/{v:id}', [ProductController::class, 'search'])->name('products.search');
    });
    Route::middleware(['customer'])->group(function(){
        Route::post('/editstatus/{o:id}', [OrderController::class, 'editStatus']);
        Route::post('/checkout',[OrderController::class, 'checkout']);
        Route::post('/minQuantity/{id}',[CartController::class, 'decreaseQuantity']);
        Route::post('/addQuantity/{id}',[CartController::class, 'addQuantity']);
        Route::post('/products/add/{id}', [CartController::class, 'addToCart']);
        Route::get('/checkout',[CartController::class, 'cartIndex']);
        Route::delete('/checkout/{id}',[CartController::class, 'deleteItem']);
        Route::get('/customer/profile',[CustomerProfileController::class, 'viewCustomerProfile']);
        Route::put('/customer/editprofile',[CustomerProfileController::class, 'editProfile']);
        Route::post('/customer/profile',[CustomerProfileController::class, 'enableEdit']);
        Route::get('/customer/editprofpic', [CustomerProfileController::class, 'showEditPict']);
        Route::put('/customer/editprofpic', [CustomerProfileController::class, 'editPicture']);
        Route::get('/customer/removeprofpic', [CustomerProfileController::class, 'removePicture']);
        Route::post('/customer/registermembership', [CustomerMembershipController::class, 'registerMembership']);
        Route::post('/customer/cancelmembership', [CustomerMembershipController::class, 'cancelMembership']);
        Route::get('/finishwithoutreview/{o:id}', [ReviewController::class, 'finishWithoutReview']);
        Route::post('/addreview/{o:id}', [ReviewController::class, 'addReview']);
    });

    Route::middleware(['vendor'])->group(function(){
        Route::post('/editstatus/{o:id}', [OrderController::class, 'editStatus']);
        Route::get('/addProduct', function () {
            return view('addProduct');
        });
        Route::get('/editProduct/{id}',[ProductController::class, 'editIndex']);
        Route::post('/addProduct', [ProductController::class, 'insertProduct']);
        Route::get('/vendor/profile',[VendorProfileController::class, 'viewVendorProfile']);
        Route::get('/product/vendor',[VendorController::class, 'showVendorProductList']);
        Route::get('/product/vendor/add',[ProductController::class, 'addIndex']);
        Route::post('/product/vendor',[ProductController::class, 'insertProduct']);
        Route::get('/product/vendor/edit/{id}',[ProductController::class, 'editIndex']);
        Route::put('/product/vendor/{id}',[ProductController::class, 'editProduct']);
        Route::put('/vendor/editprofile',[VendorProfileController::class, 'editProfile']);
        Route::post('/vendor/profile',[VendorProfileController::class, 'enableEdit']);
        Route::get('/vendor/editprofpic', [VendorProfileController::class, 'showEditPict']);
        Route::put('/vendor/editprofpic', [VendorProfileController::class, 'editPicture']);
        Route::get('/vendor/removeprofpic', [VendorProfileController::class, 'removePicture']);
        Route::post('/vendor/registermembership', [VendorMembershipController::class, 'registerMembership']);
        Route::post('/vendor/cancelmembership', [VendorMembershipController::class, 'cancelMembership']);
        Route::post('/promotion/add/{p:id}', [PromotionController::class, 'addPromotion']);

    });
     Route::get('/logout', [UserController::class, 'logout']);
});
