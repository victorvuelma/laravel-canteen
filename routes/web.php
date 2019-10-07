<?php
use Illuminate\Support\Facades\Auth;

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

Route::redirect('/', '/products')->name('home');

Route::get('/products', 'ProductController@index')->name('products');

Route::prefix('cart')->group(function() {
    Route::get('/', 'CartController@index')->name('cart.index');
    Route::get('clear', 'CartController@clear')->name('cart.clear');
    Route::post('add', 'CartController@add')->name('cart.add');
    Route::post('remove', 'CartController@remove')->name('cart.remove');
    Route::post('update', 'CartController@update')->name('cart.update');
    Route::post('order', 'CartController@order')->name('cart.order');
});

Route::prefix('account')->group(function() {
    Route::get('orders', 'CartController@index')->name('account.orders');
});

Route::prefix('auth')->group(function() {
    Auth::routes();
});

