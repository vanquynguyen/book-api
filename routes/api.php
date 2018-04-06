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
Route::group(['prefix' => '/admin', 'namespace' => 'Api\Admin', 'as' => 'api.'], function () {
    Route::resource('categories', 'CategoriesController', ['except' => ['create', 'edit']]);
    Route::get('category/search', 'CategoriesController@search');
    Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
    Route::get('user/approve/{id}', 'UserController@approve');
    Route::get('user/search', 'UserController@search');
    Route::resource('books', 'BookController', ['except' => ['create', 'edit']]);
    Route::get('book/approve/{id}', 'BookController@approve');
    Route::get('book/search', 'BookController@search');
});
Route::group(['prefix' => '/auth','middleware' => 'api', 'namespace' => 'Api\Auth', 'as' => 'api.'], function () {
    Route::resource('register', 'UserController', ['except' => ['create', 'edit']]);
    Route::resource('categories', 'CategoriesController', ['only' => ['index']]);
    Route::resource('books', 'BookController', ['except' => ['create', 'edit']]);
    Route::get('get-books', 'BookController@getBook');
    Route::resource('users', 'UserController', ['except' => ['create', 'edit']]);
    Route::get('user/search', 'UserController@search');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
    // Route::resource('books', 'BookController', ['except' => ['create', 'edit']]);
    // Route::get('book/search', 'BookController@search');
});

Route::group(['prefix' => '/auth','middleware' => 'sessions', 'namespace' => 'Api\Auth', 'as' => 'api.'], function () {
    Route::resource('carts', 'CartController', ['except' => ['create', 'edit']]);
});

Route::group(['prefix' => '/auth', 'namespace' => 'Api\Auth', 'middleware' => 'jwt.auth', 'as' => 'api.'], function () {
    Route::get('user', 'LoginController@getAuthUser');
   
});
