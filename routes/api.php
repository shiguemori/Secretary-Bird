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


/**
 * Rotas vindas a API autenticada
 */
Route::group(['namespace' => 'Api', 'middleware' => [\App\Http\Middleware\Authenticate::class, \App\Http\Middleware\AclMiddleware::class,], 'as' => 'api.'], function () {

});

/**
 * Rotas vindas de api liberadas por CORS [default => '*']
 */
Route::group(['middleware' => [\App\Http\Middleware\AddHeaders::class]], function () {

});