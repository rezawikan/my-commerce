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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::group(['middleware' => ['auth.basic']], function() {
//   Route::resource('cart', 'CartController');
//   Route::get('cartdetails', 'Api\ApiCartServiceController@cartDetails');
// });

Route::get('products', 'Api\ProductsController@index');
Route::get('products/{category?}', 'Api\ProductsController@index')->name('catalogs.index');
Route::get('products/{category}/{slug}', 'Api\ProductsController@show')->name('catalogs.show');
