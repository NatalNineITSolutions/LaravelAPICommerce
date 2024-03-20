<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\API\MakePaymentController;



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


