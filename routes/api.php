<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ParkingImageController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\JsonResponseMiddleware;
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

Route::middleware(JsonResponseMiddleware::class)->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');



    Route::resource('/cities', CityController::class)->except('create', 'edit');
    Route::resource('/likes', LikeController::class)->except('create', 'show', 'edit');
    Route::resource('/owners', OwnerController::class)->except('create', 'edit');
    Route::resource('/roles', RoleController::class)->except('create', 'edit');
    Route::resource('/rates', RateController::class)->except('create', 'edit');
    Route::resource('/users', UserController::class)->except('create', 'edit');
    Route::resource('/parking_images', ParkingImageController::class)->except('create', 'edit');
    Route::resource('/parkings', ParkingController::class)->except('create', 'edit');
});
