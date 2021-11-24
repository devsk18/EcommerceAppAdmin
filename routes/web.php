<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
//---------Home route--------------------//
Route::get('/', function(){
    return view('index');
});

//---------Authentication Routes---------//
Route::group([
    'namespace' => 'App\Http\Controllers'
],function () {
    Route::get('/login', [
        'uses' => 'AuthController@getLogin',
        'as' => 'getLogin'
    ]);
    Route::post('/login', [
        'uses' => 'AuthController@doLogin',
        'as' => 'doLogin'
    ]);
});

//---------Admin Routes---------//
Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'AdminAuth',
    'prefix' => 'admin',
],function () {

    Route::get('/dashboard', [
        'uses' => 'AdminController@getHome',
        'as' => 'getHome'
    ]);
   Route::get('/logout', [
       'uses' => 'AdminController@logout',
       'as' => 'logout'
   ]);

    Route::resources([
        'categories' => 'CategoryController', 
        'products' => 'ProductController', 
    ]);
   
});