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
Route::get('/satellites', [GeneralController::class, 'webhook']);

//Route::get('/satellites', function () {
    //Satellites::get();
    //$payLoad = json_decode(request()->get('payload'));
    //dd($payLoad);
//});