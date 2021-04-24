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

Route::post('/recruit/tweet', 'App\Http\Controllers\Api\RecruitController@store');
Route::get('/announce/diff', 'App\Http\Controllers\Api\AnnounceController@diff');
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
