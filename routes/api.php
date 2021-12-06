<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TicketsController;
use App\Http\Controllers\Api\UserController;
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

Route::group(['middleware' => 'auth:api'], function () { //TODO remove api_token?
    Route::post('/login', [AuthController::class, 'loginUser']);
    Route::post('/register', [AuthController::class, 'registerUser']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::apiResources([
        'tickets' => TicketsController::class,
        'user' => UserController::class,
    ], ['only' => ['index', 'show','update']]);

    Route::apiResource('/tickets', TicketsController::class,['only'=>['update','store']])->middleware('admin');
});
