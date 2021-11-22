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

Route::group([
    // 'middleware' => 'api',
    'name' => 'web',
    'namespace' => '\App\Modules\Web\Controllers',
], function(Illuminate\Routing\Router $router){
    $router->get('/', 'IndexController@index')->name('index');

    // $router->group(['prefix' => 'index', 'name' => 'index.'], function ($router) {
    //     $router->get('/', 'IndexController@index')->name('list');
    // });

});