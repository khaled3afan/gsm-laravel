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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/service/{service_id}', 'IndexController@show_service')->name('index.service.show');

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');
Route::post('/service/{service_id}', 'OrdersController@store')->name('order.store')->middleware('auth');
Route::get('/orders', 'OrdersController@index')->name('orders.index')->middleware('auth');
Route::resource('transactions', 'TransactionsController')->middleware('auth');

Route::group(['middleware' => ['admin']], function () {
    Route::resource('admin/services', 'ServicesController');
    Route::resource('admin/categories', 'CategoriesController');
    Route::resource('admin/users', 'UsersController');
    Route::resource('admin/servicecodes', 'ServiceCodesController')->except(['create']);
    Route::get('admin/servicecodes/create/{service}', 'ServiceCodesController@create')->name('servicecodes.create');
    Route::get('admin/services/type/{type}', 'ServicesController@serviceType');
    Route::get('admin/bundles', 'BundlesController@index')->name('bundles.index');
    Route::get('admin/bundles/{service}/create', 'BundlesController@create')->name('bundles.create');
    Route::post('admin/bundles/', 'BundlesController@store')->name('bundles.store');
});

