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
Route::get('search-dni/{dni}','API\UserController@search_dni');
Route::apiResources(['users' => 'API\UserController']);
Route::apiResources(['areas' => 'API\AreasController']);
Route::apiResources(['areas_roles' => 'API\AreasRolesController']);
Route::get('/select-areas','API\AreasController@select_areas');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
