<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllerApi;

 Route::post('level', [AuthController::class, 'level']);
 Route::post('addToMainBalance', [AuthController::class, 'addToMainBalance']);
 Route::post('register', [AuthController::class, 'register']);
 Route::post('updateBankDetails', [AuthController::class, 'updateBankDetails']);
 Route::post('products_list', [AuthController::class, 'products_list']);


 