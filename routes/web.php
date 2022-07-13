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


Route::prefix('api')->group(function () {

    

    Route::get('/index','MahasiswaController@index');
    Route::post('/create','MahasiswaController@create');
    Route::put('/update/{id}','MahasiswaController@update');
    Route::delete('/delete/{id}','MahasiswaController@delete');
    Route::get('/profile/{id}','MahasiswaController@profile');
    Route::get('search/','MahasiswaController@searchData');
    
    Route::get('/list-users','UsersController@indexUsers');
    Route::post('/create-users','UsersController@createUsers');
    Route::get('/detail-users/{id}','UsersController@detailUsers');
    Route::put('/update-users/{id}','UsersController@updateUsers');
    Route::delete('/delete-users/{id}','UsersController@deleteUsers');
    Route::get('search/','UsersController@searchUsers');

});
