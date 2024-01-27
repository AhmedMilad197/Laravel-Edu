<?php

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

Route::controller(UserController::class)->group(function () {
    Route::post('/create', 'create');
    Route::post('/login', 'login');
    
    // add role for normal user to place this api inside a gurad.
    
    Route::middleware(['auth:sanctum'])->group(function () {

        Route::post('/post', 'post');
        
        Route::middleware(['role:admin'])->group(function () {
            Route::get('/index', 'index');
        });
    });
});
