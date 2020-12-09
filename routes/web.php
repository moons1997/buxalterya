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

Route::get('/', 'MainController@home')->name('home');
Route::get('/addCategory', 'MainController@addCategory')->name('addCategory');
Route::post('/check_category', 'MainController@check_category');
Route::get('/createList', 'MainController@createList')->name('createList');
Route::get('/getSubCat/{id}', 'MainController@getSubCat');
Route::post('/check_list', 'MainController@check_list')->name('check.list');
Route::post('/check_filter', 'MainController@checkFilter')->name('check.filter');
