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


// Admin
Route::group(['prefix' => 'master'], function () {
    Route::get('/', 'AuthAdmin\LoginController@showLoginForm')->name('admin.log');
    Route::post('login', 'AuthAdmin\LoginController@login')->name('admin.login');
    Route::post('logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
    Route::get('register', 'AuthAdmin\RegisterController@showRegistrationForm');
    Route::get('password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'AuthAdmin\ResetPasswordController@reset');

    Route::group(['middleware' => ['admin.auth']], function () {
        Route::get('dashboard', 'AuthAdmin\HomeController@index')->name('admin.home');
        Route::get('products/trashes', 'ProductsController@trashes')->name('admin.products.trashes');
        Route::post('products/trashes/{product}', 'ProductsController@restore')->name('admin.products.restore');
        // Route::resource('products', 'ProductsController');
        Route::get('products', 'ProductsController@index')->name('admin.products.index');
        Route::get('products/create', 'ProductsController@create')->name('admin.products.create');
        Route::post('products', 'ProductsController@store')->name('admin.products.store');
        Route::get('products/{product}/edit', 'ProductsController@edit')->name('admin.products.edit');
        Route::match(['put', 'patch'], 'products/{product}','ProductsController@update')->name('admin.products.update');
        Route::get('products/{product}', 'ProductsController@show')->name('admin.products.show');
        Route::delete('products/{product}', 'ProductsController@destroy')->name('admin.products.destroy');
        Route::delete('upload/{basename}/{id}', 'UploadController@destroy')->name('admin.upload.delete');
        Route::post('upload/{basename}', 'UploadController@store')->name('admin.upload.store');
        Route::get('upload/{basename}/{id?}', 'UploadController@index')->name('admin.upload.index');
    });
});

// Api
Route::get('cartdetails', 'Api\ApiCartServiceController@cartDetails');
Route::get('ratingdetails/{id}', 'Api\ApiRatingServiceController@ratingDetails');


    // Customer
    Auth::routes();
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('products/trashes', 'ProductsController@trashes')->name('products.trashes');

    Route::post('catalogs/wishlists/{product}', 'ProductsController@wishlists')->name('products.wishlists');
    Route::post('catalogs/unwishlists/{product}', 'ProductsController@unwishlists')->name('products.unwishlists');
    Route::get('/', 'CatalogsController@index');
    Route::get('catalogs/{category?}', 'CatalogsController@index')->name('catalogs.index');
    Route::get('catalogs/{category}/{slug}', 'CatalogsController@show')->name('catalogs.show');
    Route::resource('categories', 'CategoriesController');

    Route::resource('cart', 'CartController');
    Route::get('wishlist', 'WishlistController@wishlistShow')->name('wishlist.show');
    Route::post('wishlist/{id}', 'WishlistController@wishlistPost')->name('wishlist.post');
    Route::post('unwishlist/{id}', 'WishlistController@unWishlistPost')->name('unwishlist.post');
    // Route::get('checkout/login', 'CheckoutController@login');
    // Route::get('checkout/login', 'CheckoutController@postLogin');
    Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


    Route::group(['middleware' => ['auth']], function () {
        Route::get('profile','UserController@index')->name('profile.index');
        Route::get('profile/edit','UserController@edit')->name('profile.edit');
        Route::put('profile/{id}','UserController@update')->name('profile.update');
    });
