<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserregisterController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\PayPalPaymentController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[UserregisterController::class,'userlist']);
// Route::get('registerr',[UserregisterController::class,'registerr']);
Route::get('userlist',[UserregisterController::class,'userlist']);
Route::post('usre-register',[UserregisterController::class,'userRegister']);

Route::get('razorpay', [RazorpayController::class, 'razorpay'])->name('razorpay');
Route::post('razorpaypayment', [RazorpayController::class, 'payment'])->name('payment');

Route::get('handle-payment', [PayPalPaymentController::class,'handlePayment'])->name('make.payment');
Route::get('cancel-payment', [PayPalPaymentController::class,'paymentCancel'])->name('cancel.payment');
Route::get('payment-success', [PayPalPaymentController::class,'paymentSuccess'])->name('success.payment');
