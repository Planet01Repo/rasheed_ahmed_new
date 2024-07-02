<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Api\Auth\AuthController@login');
    Route::post('signup', 'Api\Auth\AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'Api\Auth\AuthController@logout');
        Route::get('user', 'Api\Auth\AuthController@user');
    });
});
Route::group([
    'prefix' => 'visitor'
], function () {
    Route::get('visitor_list', 'Api\VisitorController@visitor_list');
    Route::get('missing_checked_list', 'Api\VisitorController@missing_checked_list');
    Route::get('missing_checked_out_list', 'Api\VisitorController@missing_checked_out_list');
    Route::get('checked_list', 'Api\VisitorController@checked_list');
    Route::post('add', 'Api\VisitorController@add');
    Route::post('post_checked_out', 'Api\VisitorController@post_checked_out');
    

});