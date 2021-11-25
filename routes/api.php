<?php

use App\Http\Controllers\Api\TicketsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tickets', [TicketsController::class, 'index']);
Route::get('/tickets/{id}', [TicketsController::class, 'show']);
Route::post('/tickets', [TicketsController::class, 'store']);
Route::post('/tickets/{id}/answers', [TicketsController::class, 'answer']);
Route::delete('/tickets/{id}', [TicketsController::class, 'delete']);
Route::delete('/tickets/{id}/answers', [TicketsController::class, 'resetAnswers']);
Route::resource('/tickets', 'TicketsController', ['only' => ['index', 'show']]);
