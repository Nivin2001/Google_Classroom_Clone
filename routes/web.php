<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
}) ->name('home');

Route::get('/classrooms',[ClassroomsrController::class,'index'])
//    لهاد الراوت registerionبمعنى لما اعمل
//ويستدعيه راح يروح ع الكونترلور راح يروح ع دالة index
->name('classrooms.index');

Route::get('/classrooms/create',[ClassroomsrController::class,'create'])
->name('classrooms.create');
// لانه بدون باراميتر بحطه قبل show

Route::post('/classrooms',[ClassroomsrController::class,'store'])
->name('classrooms.store');

Route::get('/classrooms/{classroom}',[ClassroomsrController::class,'show'])
->name('classrooms.show')
->where('classroom','\d+'); //reqular expersiion
// بستخدمها عشان اتاكد اذا اليوزر دخل الايميل صح او لا
Route::get('/classrooms/{classroom}/edit',[ClassroomsrController::class,'edit'])
->name('classrooms.edit')
->where('classroom','\d+');

Route::put('/classrooms/{classroom}',[ClassroomsrController::class,'update'])
->name('classrooms.update')
->where('classroom','\d+');

Route::delete('/classrooms/{classroom}',[ClassroomsrController::class,'destroy'])
->name('classrooms.destroy')
->where('classroom','\d+');


//Route Model Finding
// Route::resource('/admin/classrooms', ClassroomsController::class)
// ->names([
//     'index' =>'classrooms/index',
//     'carete'=>'classrooms/create',

// ])
// ->where(['classrooms'=>'/d+']);

Route::get('/topics',[TopicController::class,'index'])
//    لهاد الراوت registerionبمعنى لما اعمل
//ويستدعيه راح يروح ع الكونترلور راح يروح ع دالة index
->name('Topic.index');


