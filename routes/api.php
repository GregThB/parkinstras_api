<?php

use App\Http\Controllers\CityController;
use App\Http\Middleware\JsonResponseMiddleware;
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

Route::middleware(JsonResponseMiddleware::class)->group(function () {
    Route::resource('/cities', CityController::class)->except('create', 'edit');
});
