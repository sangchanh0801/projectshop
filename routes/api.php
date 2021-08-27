<?php

use App\Http\Controllers\Api\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
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
Route::get('brands', 'App\Http\Controllers\Api\BrandController@index');
Route::get('brands/{id}', 'App\Http\Controllers\Api\BrandController@show');
Route::post('brands', 'App\Http\Controllers\Api\BrandController@store');
Route::delete('brands/{id}', 'App\Http\Controllers\Api\BrandController@destroy');
Route::put('brands/{id}', 'App\Http\Controllers\Api\BrandController@update');



Route::resource('users', UserController::class);









Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found'], 404);
});
// Route::resource('carts', CartController::class);
