<?php

use Illuminate\Http\Request;

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

Route::get('/', 'RecipesController@index');
Route::get('/categories', 'CategoryController@index');


Route::get('/categories/{categoryName}', 'CategoryController@showCategoryItems');

Route::get('/recipes', 'RecipesController@index');
Route::get('/recipes/{id}', 'RecipesController@show');

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

Route::post('/recipe/{recipeName}', 'recipesController@update');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/categories/create', 'CategoryController@store');
    Route::post('/recipes/create', 'RecipesController@store');
    Route::post('/recipes/delete/{id}', 'RecipesController@destroy');
});

