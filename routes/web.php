<?php
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
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

// Route::get('/',[BookController::class, 'index']);
Route::get('/contact-us',[ContactUsController::class, 'index']);
Route::get('/publisher',[PublisherController::class, 'index']);
Route::get('/publisher/{id}',[PublisherController::class, 'showDetail']);
Route::get('/category/{id}',[CategoryController::class, 'showBooks']);
Route::get('/bookDetail/{id}',[BookController::class, 'showDetail']);
Route::get('/', function(){
return view('homepage');
});
