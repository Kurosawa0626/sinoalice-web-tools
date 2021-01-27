<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('announce', 'App\Http\Controllers\AnnounceController@index');
Route::get('announce/detail/{id}', 'App\Http\Controllers\AnnounceController@detail');

Route::get('recruit', 'App\Http\Controllers\RecruitController@index');
Route::get('recruit/search/{type}', 'App\Http\Controllers\RecruitController@search');
