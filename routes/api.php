<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\JwtMiddleware;

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

Route::post('register', 'UsersController@register');
Route::post('login', 'UsersController@login');

Route::get('/list-users','UsersController@indexUsers')->middleware('jwt.verify');
Route::post('/create-users','UsersController@createUsers')->middleware('jwt.verify');
Route::get('/detail-users/{id}','UsersController@detailUsers')->middleware('jwt.verify');
Route::put('/update-users/{id}','UsersController@updateUsers')->middleware('jwt.verify');
Route::delete('/delete-users/{id}','UsersController@deleteUsers')->middleware('jwt.verify');
Route::get('search/','UsersController@searchUsers')->middleware('jwt.verify');

Route::get('/index','MahasiswaController@index');
Route::post('/create','MahasiswaController@create');
Route::put('/update/{id}','MahasiswaController@update');
Route::delete('/delete/{id}','MahasiswaController@delete');
Route::get('/profile/{id}','MahasiswaController@profile');
Route::get('search/','MahasiswaController@searchData');
