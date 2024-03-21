<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\API\MakePaymentController;


use App\Http\Controllers\PlanController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\User\SubscriptionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register',[RegisterController::class,'register']);
Route::post('/login',[LoginController::class,'loginUser']);
Route::post('/forgot-password',[ForgotPasswordController::class,'sendResetLinkEmail']);

//subscription
Route::post('/make-payment/{id}',[MakePaymentController::class,'makePayment']);
Route::post('/payment-response/{id}',[MakePaymentController::class,'paymentResponse']);


//call back
Route::match(array('GET', 'POST'), 'verify', [OrderController::class, 'verify'])->name('payment.verify');
Route::get('/package', [PackageController::class, 'index']);


Route::get('/plans',[PlanController::class,'index']);
Route::post('/plans',[PlanController::class,'upload']);
Route::post('/subscriptions',[SubscriptionController::class,'uploadsubscriptions']);
Route::post('/subscribers',[SubscriptionController::class,'uploadsubscribers']);
