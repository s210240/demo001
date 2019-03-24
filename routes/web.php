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

Route::get('/', function () {
    return view('welcome');
});

Route::get('hungry', 'CommonController@hungry');
Route::post('add_pet', 'CommonController@addPet');
Route::get('list_pets', 'CommonController@ListPets');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
