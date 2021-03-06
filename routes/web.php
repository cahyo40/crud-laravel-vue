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
Route::get('/data',function(){
    return view('data');
});
Route::get('/chat',function(){
    return view('chat');
});
Route::get('/api/data','AnggotaController@index');
Route::get('/api/data/{cari}','AnggotaController@index1');
Route::post('/api/data','AnggotaController@store');
Route::delete('/api/data/{id}','AnggotaController@destroy');
Route::get('/api/data/{id}/pilih','AnggotaController@show');
Route::post('/api/data/{id}/edit','AnggotaController@update');
Route::get('/api/chat','ChatController@index');
Route::post('/api/chat','ChatController@store');
