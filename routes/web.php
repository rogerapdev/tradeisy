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

Route::get('/', function () {
    return redirect('login');
});

// Auth::routes();

// Login Routes...
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => '', 'uses' => 'Auth\LoginController@login']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

//System Routes...
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Brokers Routes
    |--------------------------------------------------------------------------
     */

    Route::name('brokers.')->prefix('brokers')->group(function () {
        Route::get('/')->name('index')->uses('BrokerController@index');
        Route::get('create')->name('create')->uses('BrokerController@create');
        Route::post('create')->name('store')->uses('BrokerController@store');
        Route::get('{id}')->name('edit')->uses('BrokerController@edit');
        Route::put('{id}')->name('update')->uses('BrokerController@update');
        Route::get('{id}/delete')->name('delete')->uses('BrokerController@delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Dividends Routes
    |--------------------------------------------------------------------------
     */

    Route::name('dividends.')->prefix('dividends')->group(function () {
        Route::get('/')->name('index')->uses('DividendController@index');
        Route::get('create')->name('create')->uses('DividendController@create');
        Route::post('create')->name('store')->uses('DividendController@store');
        Route::get('{id}')->name('edit')->uses('DividendController@edit');
        Route::put('{id}')->name('update')->uses('DividendController@update');
        Route::get('{id}/delete')->name('delete')->uses('DividendController@delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Deposits Routes
    |--------------------------------------------------------------------------
     */

    Route::name('deposits.')->prefix('deposits')->group(function () {
        Route::get('/')->name('index')->uses('DepositController@index');
        Route::get('create')->name('create')->uses('DepositController@create');
        Route::post('create')->name('store')->uses('DepositController@store');
        Route::get('{id}')->name('edit')->uses('DepositController@edit');
        Route::put('{id}')->name('update')->uses('DepositController@update');
        Route::get('{id}/delete')->name('delete')->uses('DepositController@delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Orders Routes
    |--------------------------------------------------------------------------
     */

    Route::name('orders.')->prefix('orders')->group(function () {
        Route::get('/')->name('index')->uses('OrderController@index');
        Route::get('create')->name('create')->uses('OrderController@create');
        Route::post('create')->name('store')->uses('OrderController@store');
        Route::get('{id}')->name('edit')->uses('OrderController@edit');
        Route::put('{id}')->name('update')->uses('OrderController@update');
        Route::get('{id}/delete')->name('delete')->uses('OrderController@delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Stocks Routes
    |--------------------------------------------------------------------------
     */

    Route::name('stocks.')->prefix('stocks')->group(function () {
        Route::get('quote')->name('quote')->uses('StockController@quote');
    });

    /*
    |--------------------------------------------------------------------------
    | Radars Routes
    |--------------------------------------------------------------------------
     */

    Route::name('radars.')->prefix('radars')->group(function () {
        Route::get('/')->name('index')->uses('RadarController@index');
        Route::post('create')->name('store')->uses('RadarController@store');
    });
});
