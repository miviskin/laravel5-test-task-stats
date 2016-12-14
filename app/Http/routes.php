<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

// Guest routes
Route::group(['middleware' => ['stats']], function () {

    Route::get('/', function () {
        return view('blog.post');
    });

    Route::get('/page/{name}', function ($name) {
        return view('blog.post', ['title' => ucfirst($name)]);
    });

});

// Admin routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('/', function () {
        return redirect('/admin/stats');
    });

    Route::group(['prefix' => 'stats'], function () {

        Route::get('/', 'StatsController@showGeneral');
    });
});
