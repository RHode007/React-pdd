<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TicketsController;
use App\Http\Controllers\Api\UserController;
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

Route::group(['middleware' => 'auth:api'], function () { //TODO remove api_token?
    Route::post('/login', [AuthController::class, 'loginUser']);
    Route::post('/register', [AuthController::class, 'registerUser']);
    //Route::resource('/tickets', 'TicketsController', ['only' => ['index', 'show']]);
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::apiResources([
        'tickets' => TicketsController::class,
        'user' => UserController::class,
    ]);
    //Route::resource('/tickets', 'TicketsController', ['only' => ['index', 'show']]);
    //Route::resource('/user', 'UserController');
});

//TODO tickets/index->login->dashboard(HOME)
//Route::get('/tickets', [TicketsController::class, 'index']);
//Route::get('/tickets/{id}', [TicketsController::class, 'show']);
//Route::post('/tickets', [TicketsController::class, 'store']);
//Route::post('/tickets/{id}/answers', [TicketsController::class, 'answer']);
//Route::delete('/tickets/{id}', [TicketsController::class, 'delete']);
//Route::delete('/tickets/{id}/answers', [TicketsController::class, 'resetAnswers']);

