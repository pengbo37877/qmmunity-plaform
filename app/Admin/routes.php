<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('users', UserController::class);
    $router->resource('businesses', BusinessController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('qkeys', QkeyController::class);
    $router->resource('rates', RateController::class);
    $router->resource('reviews', ReviewController::class);
    $router->resource('user-profiles', UserProfileController::class);
    $router->resource('ads', AdController::class);
});
