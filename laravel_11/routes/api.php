<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', [AuthController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'destroy']);
    
   // Route::post('/verify-email', [EmailController::class, 'send_verification']);
   // Route::post('/email-verification/{id}/{hash}', [EmailController::class, 'verify_email']);
});

Route::post('/signup', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);