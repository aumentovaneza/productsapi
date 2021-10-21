<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group( function() {
    Route::post('/user/login', [AuthenticationController::class, 'login']);

    Route::middleware('auth:api')->group(function() {

        Route::prefix('products')->group(function() {
            Route::get('/',[ProductController::class, 'getProducts']);
        });

        Route::prefix('user')->group(function() {
            Route::get('/', [UserController::class, 'getUser']);

            Route::prefix('products')->group(function() {
                Route::get('/', [ProductController::class, 'getUserProducts']);
                Route::post('/', [ProductController::class, 'postUserProducts']);
                Route::delete('/{SKU}', [ProductController::class, 'deleteUserProduct']);
            });


        });
    });
});

