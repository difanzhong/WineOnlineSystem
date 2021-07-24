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

// Route::get('/', function () {
//     return view('/', '
// });



Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'admin'], function() {
        Route::get('/create', 'CreateWineController@create');
    });
    Route::view('/', 'wine/list')->name('wine-list');
    Route::view('wines/index', 'wine/list')->name('wine-list');
    Route::view('/clients/index', 'client/list')->name('client-list');
    Route::view('/orders/index', 'order/list')->name('order-list');
});

Route::get('/home', 'HomeController@index')->name('home');


