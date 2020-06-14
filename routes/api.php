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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::apiResource('user', 'Api\UserController');
    Route::apiResource('admin_settings', 'Api\AdminSettingsController');
    Route::get('total/books', 'Api\BookController@TotalBooks');
    Route::apiResource('/books', 'Api\BookController');

    Route::prefix('books')->name('books')->group(function() {
        Route::get('/category/all', 'Api\BookCategoryController@index');
        Route::apiResource('/category', 'Api\BookCategoryController');
    });
});

