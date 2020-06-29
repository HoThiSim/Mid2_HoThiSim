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

Route::get('/', function () {
    return view('welcome');
});
Route::get('index',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]);
Route::get('loai-san-pham/{type}',
    "PageController@getLoaiSp")->name('loaisanpham');

Route::get('lien_he', [
    'as'=>'lienhe',
    'uses'=>'PageController@getLienhe'
]);
Route::get('gioi_thieu',[
    'as'=>'about',
    'uses'=>'PageController@getAbout'
]);

Route::get('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@getChitiet'
]);

Route::get('add-to-cart/{id}',[
    'as'=>'themgiohang',
    'uses'=>'PageController@getAddtoCart'
]);

Route::get('del-cart/{id}', [
    'as'=>'xoagiohang',
    'uses'=>'PageController@getDelItemCart'
]);

Route::get('dat-hang',[
	'as' =>'dathang',
	'uses'=>'PageController@getCheckout'
	]);
Route::post('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@postCheckout'
    ]);

Route::get('/login',"PageController@getLogin");
Route::post('/login', "PageController@login");

Route::get('/register', 'PageController@getRegister');
Route::post('/register', 'PageController@register');
Route::post("/logout","PageController@logout");
