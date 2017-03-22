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

// product routes ---------------------------------------------------

Route::get('/', [
	'uses'=>'productController@index',
	'as'=>'product.index'
	]);

Route::get('/add-to-cart/{id}', [
	'uses'=>'productController@getAddToCart',
	'as'=>'product.addToCart'
	]);

Route::get('/reduce/{id}', [
	'uses'=>'productController@getReduceByOne',
	'as'=>'product.reduceByOne'
	]);

Route::get('/remove/{id}', [
	'uses'=>'productController@getRemoveItem',
	'as'=>'product.remove'
	]);


Route::get('/shopping-cart', [
	'uses'=>'productController@create',
	'as'=>'product.shoppingCart'
	]);


Route::get('/showItem/{id} ', [
	'uses'=>'productController@show',
	'as'=>'product.showItem'
	]);


Route::get('/createProduct', 'AdminHomeController@createProduct');



Route::post('/storeProduct', [
	'uses'=>'AdminHomeController@storeProduct',
	'as'=>'storeproduct',
	'middleware'=>'DeniedIfNotAdmin'
]);

Route::get('/editProduct/{id}', [
	'uses'=>'AdminHomeController@edit',
	'as'=>'product.edit'
]);

Route::put('/updateProduct/{id}', [
	'uses'=>'AdminHomeController@update',
	'as'=>'product.update'
]);

Route::delete('/deleteProduct/{id}', [
	'uses'=>'AdminHomeController@destroy',
	'as'=>'product.delete'
]);



// check out ---------------------------------------------------

Route::get('/checkout', [
	'uses'=>'productController@getCheckout',
	'as'=>'checkout',
	'middleware'=>'auth'
	]);

Route::post('/checkout', [
	'uses'=>'productController@postCheckout',
	'as'=>'checkout',
	'middleware'=>'auth'
	]);

// authentication routes ----------------------------------------------

Auth::routes();


Route::get('/logout', 'productController@logout');

Route::get('/userProfile', [
	'uses'=>'HomeController@index',
	'as'=>'profile',
	'middleware'=>'auth'
	]);

Route::get('/home', 'AdminHomeController@redirectAfterRegister');

// Admin routes ---------------------------------------------------------

Route::get('/admin_home', 'AdminHomeController@index');

Route::get('admin_login','AdminAuth\LoginController@showLoginForm');
Route::post('admin_login','AdminAuth\LoginController@Login');
Route::get('admin_logout','AdminAuth\LoginController@logout');

Route::post('admin_password/email','AdminAuth\ForgotPasswordController@sendResetLink');
Route::get('admin_password/reset','AdminAuth\ForgotPasswordController@showLinkRequestForm');

Route::post('admin_password/reset','AdminAuth\ResetPasswordController@reset');

Route::get('admin_password/reset/{token}','AdminAuth\ResetPasswordController@showResetForm');

Route::get('admin_register','AdminAuth\RegisterController@showRegistrationForm');

Route::post('admin_register','AdminAuth\RegisterController@register');



