<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;


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
    return redirect()->route('home');
});



Auth::routes([
    'register' => true
]);

Route::get('/home', function(){
    return "Hello Home Page";
})->middleware(['redirect'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function(){
  Route::get('dashbooard','App\Http\Controllers\AdminController@index')->name('admin.index');
  ///Resource
  Route::resource('course','App\Http\Controllers\CourseController');
  Route::resource('teacher', 'App\Http\Controllers\AdminTeacherController');
  Route::resource('student', 'App\Http\Controllers\StudentController');
  Route::resource('subject', 'App\http\Controllers\SubjectsController');

  /// Simple get Route
  Route::match(['GET','POST','DELETE'],'setting',[App\Http\Controllers\SettingController::class,'index'])->name('setting.index');


});
Route::group(['prefix' => 'teacher', 'middleware' => ['auth','teacher']], function(){
    Route::get('dashboard','App\Http\Controllers\TeacherController@index')->name('teacher.dash');
  });
