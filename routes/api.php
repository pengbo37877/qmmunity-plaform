<?php

use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\HomeController;
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

Route::get('/home_categories', [HomeController::class, 'categories']);
Route::get('/home_businesses', [HomeController::class, 'businesses']);
Route::get('/home_ads', [HomeController::class, 'ads']);
Route::get('/home_notice', [HomeController::class, 'notice']);
Route::get('/home_search', [HomeController::class, 'search']);
Route::get('/city', [AddressController::class, 'city']);
Route::get('/area', [AddressController::class, 'area']);
Route::get('/config', [AddressController::class, 'key']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('users', UserController::class);
    Route::any('update_user_info/{id}', [UserController::class, 'updateUserInfo']);
});
