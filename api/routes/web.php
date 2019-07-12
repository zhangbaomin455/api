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

Route::get('index',"IndexController@index");


Route::get('read',"IndexController@read");

Route::group(['prefix'=>'app','middleware'=>'jwtAuto'],function (){
    Route::get('checktoken',"IndexController@checktoken");
});

Route::post('login','LoginController@index');