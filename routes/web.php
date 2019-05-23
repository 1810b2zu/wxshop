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
route::prefix('admin')->group(function (){
   route::get('menu','MenuController@menu');
    route::post('menuAdd','MenuController@menuAdd');
    route::get('menulist','MenuController@menulist');
    route::any('getmenu/{id}','MenuController@getmenu');
    route::any('forbidden/{id}','MenuController@forbidden');
});
