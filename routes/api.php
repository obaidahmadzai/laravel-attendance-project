<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Course;
use GuzzleHttp\Middleware;

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
Route::get('/product', function(){
    return Course::all();
});
Route::middleware(['admin', 'auth'])->prefix('admins')->group( function () {
    Route::get('/dashbooard','App\Http\Controllers\AdminController@index')->name('admin.index');
});
Route::group(['prefix' => 'admin', 'middleware' => []], function(){
    Route::get('dashbooard','App\Http\Controllers\AdminController@index')->name('admin.index');
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
