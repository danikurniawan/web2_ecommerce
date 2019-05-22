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

Route::get('/', 'FrontController@index');

Auth::routes();

//Public
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post', 'PostController@index');
Route::get('/verifyUser/{token}', 'Auth\RegisterController@verifyUser');
Route::get('product_public', 'Admin\ProductController@product_public');
Route::get('product_public/show/{id}', 'Admin\ProductController@detail_product');
Route::get('images_product/view/{fileName}', 'Admin\ProductController@viewImage');

Route::get('carts', 'CartController@index')->name('carts.index');
Route::get('carts/add/{id}', 'CartController@add')->name('carts.add');
Route::patch('carts/update', 'CartController@update')->name('carts.update');
Route::delete('carts/remove', 'CartController@remove')->name('carts.remove');

Route::group(['middleware' => ['auth']], function () {

    Route::post('simpan_review', 'Admin\ProductController@simpan_review');

    Route::name('admin.')->group(function() {

        Route::group(['prefix' => 'admin'], function () {
            Route::get('product/{id}/delete', 'Admin\ProductController@destroy');
            Route::resource('product', 'Admin\ProductController');
            Route::get('images_product/view/{fileName}', 'Admin\ProductController@viewImage');
            Route::get('images/view/{fileName}', 'Admin\ImageController@viewImage');
            Route::get('videos/view/{fileName}', 'Admin\VideoController@viewVideo');
            Route::resource('images', 'Admin\ImageController');
            Route::resource('videos', 'Admin\VideoController');
            Route::resource('orders', 'Admin\OrderController');
            
        });

    });
    
});
