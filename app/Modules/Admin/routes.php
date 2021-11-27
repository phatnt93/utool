<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLoginAdmin;

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

Route::name('admin.')
    ->prefix('admin')
    ->namespace('\App\Modules\Admin\Controllers')
    ->middleware(['admin'])
    ->group(function(){
        Route::middleware([CheckLoginAdmin::class])->group(function(){
            Route::get('/login', 'AuthController@login')->name('login');
            Route::post('/login', 'AuthController@doLogin')->name('doLogin');
            Route::get('/logout', 'AuthController@logout')->name('logout');
        });

        Route::middleware(['auth:admin', CheckLoginAdmin::class])->group(function(){
            
            
            // Dashboard
            Route::get('/', 'IndexController@index')->name('dashboard');

            // Menu
            Route::name('menu.')
                ->prefix('menu')
                ->group(function(){
                    Route::get('/', 'MenuController@manage')->name('manage');
                    Route::post('/datatable', 'MenuController@datatable')->name('datatable');
                    Route::get('/create', 'MenuController@create')->name('create');
                    Route::post('/create', 'MenuController@store')->name('store');
                    Route::get('/edit/{id}', 'MenuController@edit')->name('edit')->where('id', '[0-9]+');
                    Route::post('/edit/{id}', 'MenuController@update')->name('update')->where('id', '[0-9]+');
                    Route::post('/delete', 'MenuController@delete')->name('delete');
                });

            // User
            Route::name('user.')
                ->prefix('user')
                ->group(function(){
                    Route::get('/', 'UserController@manage')->name('manage');
                    Route::post('/datatable', 'UserController@datatable')->name('datatable');
                    Route::get('/create', 'UserController@create')->name('create');
                    Route::post('/create', 'UserController@store')->name('store');
                    Route::get('/edit/{id}', 'UserController@edit')->name('edit')->where('id', '[0-9]+');
                    Route::post('/edit/{id}', 'UserController@update')->name('update')->where('id', '[0-9]+');
                    Route::post('/delete', 'UserController@delete')->name('delete');
                });
        });
    });