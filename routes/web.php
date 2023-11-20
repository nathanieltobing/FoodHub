<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PublisherController;

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

// Route::get('/',[BookController::class, 'index']);
Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');
Route::get('/register', function () {
    return view('register');
})->name('register')->middleware('guest');
Route::get('/register/{lang}', function ($lang) {
    App::setLocale($lang);
    return view ('register');
})->name('register')->middleware('guest');
Route::get('/contact-us',[ContactUsController::class, 'index']);
Route::get('/publisher',[PublisherController::class, 'index']);
Route::get('/publisher/{id}',[PublisherController::class, 'showDetail']);
Route::get('/category/{id}',[CategoryController::class, 'showBooks']);
Route::get('/bookDetail/{id}',[BookController::class, 'showDetail']);

Route::get('/', function(){
return view('homepage');
});

Route::get('/orderlist/{c:id}',[OrderController::class, 'viewOrderList']);
Route::post('/editstatus/{o:id}', [OrderController::class, 'editStatus']);
