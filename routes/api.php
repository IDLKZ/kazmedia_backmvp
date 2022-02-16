<?php

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', [\App\Http\Controllers\Api\AuthController::class,"login"]);
    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class,"logout"]);
    Route::post('refresh', [\App\Http\Controllers\Api\AuthController::class,"refresh"]);
    Route::post('me', [\App\Http\Controllers\Api\AuthController::class,"me"]);
    Route::post("register",[\App\Http\Controllers\Api\AuthController::class,"register"]);
    Route::post("forget",[\App\Http\Controllers\Api\AuthController::class,"forget"]);
});

Route::group(["middleware" => "auth:api"],function (){
    Route::get("getRooms",[\App\Http\Controllers\Api\ApiServerController::class,"getRooms"]);
});
