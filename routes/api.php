<?php

use Illuminate\Http\Request;
use App\Http\Controllers\GeneralController;

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
Route::post('/topsecret', [GeneralController::class, 'topsecret']);
Route::post('/topsecret_split/{satellite_name}', [GeneralController::class, 'topsecret_split_name']);
Route::get('/topsecret_split', [GeneralController::class, 'topsecret_split']);