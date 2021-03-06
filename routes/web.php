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
Route::get('/category/{category_id}', 'IndexController@show_category')->name('index.category');
Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');
Route::post('/service/{service_id}', 'OrdersController@store')->name('order.store')->middleware('auth');
Route::get('/orders', 'OrdersController@index')->name('orders.index')->middleware('auth');
Route::resource('transactions', 'TransactionsController')->middleware('auth');
Route::get('balance', 'TransactionsController@user_balance')->name('index.balance')->middleware('auth');
Route::post('balance', 'TransactionsController@add_balance')->name('index.add_balance')->middleware('auth');

Route::group(['middleware' => ['admin']], function () {
    Route::resource('admin/services', 'ServicesController');
    Route::resource('admin/categories', 'CategoriesController');
    Route::resource('admin/users', 'UsersController');
    Route::resource('admin/servicecodes', 'ServiceCodesController')->except(['create']);
    Route::get('admin/servicecodes/create/{service}', 'ServiceCodesController@create')->name('servicecodes.create');
    Route::get('admin/bundlecodes/{bundle}/create', 'ServiceCodesController@create_codes_by_bundle')->name('bundlecodes.create');
    Route::get('admin/services/type/{type}', 'ServicesController@serviceType');
    Route::get('admin/bundles', 'BundlesController@index')->name('bundles.index');
    Route::get('admin/bundles/{bundle}', 'BundlesController@show')->name('bundles.show');
    Route::delete('admin/bundles/{bundle}', 'BundlesController@destroy')->name('bundles.destroy');
    Route::get('admin/bundles/{service}/create', 'BundlesController@create')->name('bundles.create');
    Route::post('admin/bundles/', 'BundlesController@store')->name('bundles.store');
    Route::get('admin/orders', 'OrdersController@admin_show')->name('orders.admin_show');
    Route::resource('admin/giftcards', 'GiftCardsController');
});

