<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InexportController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
//User
Route::post('/profile', [UserController::class, 'updateProfile']);
Route::get('/profile/{id}', [UserController::class, 'getInfor']);
Route::get('/profile', [UserController::class, 'getUser']);
//Book
Route::get('/books', [BookController::class, 'getAllbook']);
Route::post('/books', [BookController::class, 'addBook']);
Route::delete('/books/{book_id}', [BookController::class, 'deleteBook']);
Route::get('/books/{id}', [BookController::class, 'getBook']);
Route::post('/books/search', [BookController::class, 'searchbook']);
//Order
Route::get('/order', [OrderController::class, 'getOrder']);
Route::get('/order/user/{id}', [OrderController::class, 'getOrderByUser']);
Route::get('/order/{order_id}', [OrderController::class, 'getOrderInfor']);

//Cart
Route::post('/cart/add', [OrderController::class, 'addcart']);
Route::post('/cart', [OrderController::class, 'getcart']);
Route::put('/cart/{book_id}/{scope}', [OrderController::class, 'updatecart']);
Route::delete('/cart/{book_id}', [OrderController::class, 'deletecart']);
//Payment
Route::post('/payment', [PaymentController::class, 'processpayment']);
Route::get('/payment/infor', [PaymentController::class, 'getinfor']);
Route::post('/payment/trans', [PaymentController::class, 'createTran']);
//Coupon
Route::post('/coupons', [CouponController::class, 'addCoupon']);
Route::post('/coupons/exchange', [CouponController::class, 'exchange']);
Route::get('/coupons', [CouponController::class, 'getAllCoupon']);
Route::get('/coupons/mycoupon', [CouponController::class, 'getmycoupon']);
Route::delete('/coupons/{coupon_id}', [CouponController::class, 'deletecoupon']);

Route::post('/coupons/apply', [CouponController::class, 'apply']);


//Inexport
Route::post('/imexport', [InexportController::class, 'createinexport']);
Route::get('/imexport/{id}', [InexportController::class, 'getdetail']);
Route::get('/export', [InexportController::class, 'export']);
Route::get('/import', [InexportController::class, 'import']);
Route::put('/imexport/{id}/{status}', [InexportController::class, 'updatestatus']);

//Event
Route::post('/events', [EventController::class, 'createevent']);
Route::get('/events', [EventController::class, 'event']);
Route::put('/events/{id}', [EventController::class, 'update']);





