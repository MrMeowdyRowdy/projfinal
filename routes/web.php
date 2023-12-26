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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth', 'permission']], function () {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        /**
         * User Routes
         */
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/create', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
        });

        /**
         * llamadas Routes
         */
        Route::group(['prefix' => 'llamadas'], function () {
            Route::get('/', 'LlamadasController@index')->name('llamadas.index');
            Route::get('/create', 'LlamadasController@create')->name('llamadas.create');
            Route::post('/create', 'LlamadasController@store')->name('llamadas.store');
            Route::get('/{llamada}/show', 'LlamadasController@show')->name('llamadas.show');
            Route::get('/{llamada}/edit', 'LlamadasController@edit')->name('llamadas.edit');
            Route::patch('/{llamada}/update', 'LlamadasController@update')->name('llamadas.update');
            Route::delete('/{llamada}/delete', 'LlamadasController@destroy')->name('llamadas.destroy');
        });
        /**
         * rcps Routes
         */
        Route::group(['prefix' => 'rcps'], function () {
            Route::get('/', 'RcpsController@index')->name('rcps.index');
            Route::get('/create', 'RcpsController@create')->name('rcps.create');
            Route::post('/create', 'RcpsController@store')->name('rcps.store');
            Route::get('/{rcp}/show', 'RcpsController@show')->name('rcps.show');
            Route::get('/{rcp}/edit', 'RcpsController@edit')->name('rcps.edit');
            Route::patch('/{rcp}/update', 'RcpsController@update')->name('rcps.update');
            Route::delete('/{rcp}/delete', 'RcpsController@destroy')->name('rcps.destroy');
        });
        /**
         * horarios Routes
         */
        Route::group(['prefix' => 'horarios'], function () {
            Route::get('/', 'HorariosController@index')->name('horarios.index');
            Route::get('/create', 'HorariosController@create')->name('horarios.create');
            Route::post('/create', 'HorariosController@store')->name('horarios.store');
            Route::get('/{horario}/show', 'HorariosController@show')->name('horarios.show');
            Route::get('/{horario}/edit', 'HorariosController@edit')->name('horarios.edit');
            Route::patch('/{horario}/update', 'HorariosController@update')->name('horarios.update');
            Route::delete('/{horario}/delete', 'HorariosController@destroy')->name('horarios.destroy');
        });

        /**
         * proveedors Routes
         */
        Route::group(['prefix' => 'proveedors'], function () {
            Route::get('/', 'ProveedorsController@index')->name('proveedors.index');
            Route::get('/create', 'ProveedorsController@create')->name('proveedors.create');
            Route::post('/create', 'ProveedorsController@store')->name('proveedors.store');
            Route::get('/{proveedor}/show', 'ProveedorsController@show')->name('proveedors.show');
            Route::get('/{proveedor}/edit', 'ProveedorsController@edit')->name('proveedors.edit');
            Route::patch('/{proveedor}/update', 'ProveedorsController@update')->name('proveedors.update');
            Route::delete('/{proveedor}/delete', 'ProveedorsController@destroy')->name('proveedors.destroy');
        });



        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);
    });
});