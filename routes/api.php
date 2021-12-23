<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TicketsAnswersController;
use App\Http\Controllers\Api\TicketsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserTicketResultController;
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

Route::group([], function () {
    Route::post('/login', [AuthController::class, 'loginUser']);
    Route::post('/register', [AuthController::class, 'registerUser']);
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'tickets'], function () {
        Route::apiResource('/',TicketsController::class);
        Route::get('/getAll', [TicketsController::class, 'getAll']);
        Route::get('/getRandom', [TicketsController::class, 'getRandom']);

        Route::get('{tickets}/answers/getRandom', [TicketsAnswersController::class, 'getRandom']); //TODO rework
    });
    Route::apiResource('ticket.answers', TicketsAnswersController::class)->parameter('answers','ticketsanswers');
    Route::apiResource('/userticketresults',UserTicketResultController::class);
    Route::apiResource('/user',UserController::class);
});
