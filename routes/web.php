<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomuserController;
use App\Models\Category;
use App\Models\CustomUser;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('frontend.home');
// });

/** Product */
Route::get('/',[ProductController::class,'getAllProd']);

Route::get('/show-detail/{id}',[ProductController::class,'showProdDetail']);

Route::post('/insert-rating',[ProductController::class,'insertRating']);

Route::post('/load-comment',[ProductController::class,'loadComment']);

Route::post('/send-comment',[ProductController::class,'sendComment']);

/** Category */

/** Cart */
Route::get('/Add-Cart/{id}',[CartController::class,'AddCart']);

Route::get('/Delete-Item-Cart/{id}',[CartController::class,'DeleteItemCart']);

Route::get('/List-Cart',[CartController::class,'ViewListCart']);

Route::get('/Delete-Item-List-Cart/{id}',[CartController::class,'DeleteListItemCart']);

Route::get('/Save-Item-List-Cart/{id}/{quanty}',[CartController::class,'SaveListItemCart']);

Route::post('/Save-All',[CartController::class,'SaveAllListItemCart']);

Route::get('/Check-out',[CartController::class,'Checkout'])->name('checkout');

Route::post('/Cart-payment',[CartController::class,'CartPayment'])->name('payment');

Route::post('/Check-coupon',[CartController::class,'CheckCoupon'])->name('check.coupon');

/*Customuser */
Route::get('/manage-user',[CustomuserController::class,'manageUser']);

Route::get('/edit-password/{id}',[CustomuserController::class,'editPassword']);

Route::post('/change-password/{id}',[CustomuserController::class,'changePassword']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


