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

/* Route::get('/', function () {
    return view('welcome');
}); */

/* List all categories subcategories and products */
Route::get('/', 'ListController@index')->name('list');

/* Edit category */
Route::get('/category/edit/{id}', 'ListController@edit')->name('category.edit');

/* Update category */
Route::post('/category/update', 'ListController@update')->name('category.update');

/* Store categories */
Route::post('/category/store', 'ListController@store')->name('category.create');

/* Store subcategories */
Route::post('/subcategory/store', 'ListController@storeSubCategory')->name('subcategory.create');

/* Store product */
Route::post('/product/store', 'ListController@storeProduct')->name('product.create');



/* Auth::routes();

Route::get('/home', 'HomeController@index')->name('home'); */
