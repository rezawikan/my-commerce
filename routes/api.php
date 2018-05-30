<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('cart', 'CartController');
Route::get('cartdetails', 'Api\ApiCartServiceController@cartDetails');
Route::get('ratingdetails/{id}', 'Api\ApiRatingServiceController@ratingDetails');
Route::get('catalogs/{category}', 'Api\ApiCatalogController@index')->name('catalogs.index');
Route::get('catalogs/minmax/{category}', 'Api\ApiCatalogController@minmax')->name('catalogs.minmax');
Route::get('sort/catalogs', 'Api\ApiCatalogController@sort')->name('catalogs.sort');
Route::get('brands/catalogs', 'Api\ApiCatalogController@brands')->name('catalogs.brands');
Route::get('layout/catalogs/{type?}', 'Api\ApiCatalogController@layout')->name('catalogs.layout');
Route::get('categories', 'Api\ApiCatalogController@categories')->name('categories.show');
Route::get('maps', 'Api\ApiCatalogController@maps')->name('categories.maps');
