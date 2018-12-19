<?php

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

// protected $routeMiddleware = [
//     'auth' => \App\Http\Middleware\Authenticate::class,
//     'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
//     'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
//  ];

Route::get('/advertenties','AdvertentiesController@index');

Route::get('/welcome', function () {
     return view('welcome');
});

Route::get('/inloggen', function () {
    return view('inloggen');
});

Route::get('/newAdv', function () {
    return view('newAdv');
});

Route::get('/registreren', function () {
    return view('registreren');
});

Route::get('/userPage', function () {
    return view('userPage');
});

Route::get('/openConn', function () {
    return view('openConn');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
