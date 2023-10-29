<?php

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

Route::get('/seller',[SellerController::class,'index']);
Route::post('/seller',[SellerController::class,'store']);
Route::get('/seller/{id}',[SellerController::class,'show']);
Route::put('/seller/{id}',[SellerController::class, 'update']);
Route::delete('/seller/{id}',[SellerController::class,"destroy"]);
Route::get('/sellerSerch/{phone_number}',[SellerController::class,'search']);