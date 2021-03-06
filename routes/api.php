<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

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

Route::resource('categories', CategoryController::class);

Route::get('/cat', [CategoryController::class, 'apiIndex']);
Route::get('/cat/{id}', [CategoryController::class, 'apiShow']);

Route::get('/item', [ItemController::class, 'apiIndex']);
Route::get('/item/{id}', [ItemController::class, 'apiShow']);