<?php

use App\Http\Controllers\WeChatController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

// 微信路由
Route::any('/wechat', [WeChatController::class, 'serve']); // 处理小程序客服消息，回复客服消息

// 使用code换取access_token
Route::any('/access_token', [WeChatController::class, 'accessToken']);

// 更新微信数据
Route::middleware('auth:sanctum')->get('/dashboard', function () {
    Route::any('/update_user_info/{id}', [WeChatController::class, 'updateUserInfo']);
});
