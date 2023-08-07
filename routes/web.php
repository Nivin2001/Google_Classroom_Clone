<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClassroomController;


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
}) ->name('home') ->middleware('auth');


Route::resources([
    'topics'=>TopicController::class,
    'classrooms'=>ClassroomsrController::class,
    ],[
    'middleware'=>['auth']
    // بمعنى اليوزر مش راح يقدر يدخل عليهم الا اذا كان authanicated user
    ]);

Route::get('/login',[LoginController::class,'create'])
->name('login')
->middleware('guest');

// بدي الي يدخل عليها يكون guest
// not athicated
Route::post('/login',[LoginController::class,'store'])
->middleware('guest');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','password.confirm'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/classrooms/{classrooms/people',[ClassworkController::class,'index'])
    ->name('classrooms.people');

// Route::get('/classrooms/{classroom}/join',[JoinClassroomController::class,'create'])
// ->name('classrooms.join');
// Route::post('/classrooms/{classroom}/join',[JoinClassroomController::class,'store'])
// ->name('classrooms.store');



// 'classrooms.classworks'=>ClassworkController::class
// nested resource (route)




// Route::get('/classrooms',[ClassroomsrController::class,'index'])
// //    لهاد الراوت registerionبمعنى لما اعمل
// //ويستدعيه راح يروح ع الكونترلور راح يروح ع دالة index
// ->name('classrooms.index');

// Route::get('/classrooms/create',[ClassroomsrController::class,'create'])
// ->name('classrooms.create');
// // لانه بدون باراميتر بحطه قبل show

// Route::post('/classrooms',[ClassroomsrController::class,'store'])
// ->name('classrooms.store');

// Route::get('/classrooms/{classroom}',[ClassroomsrController::class,'show'])
// ->name('classrooms.show')
// ->where('classroom','\d+'); //reqular expersiion
// // بستخدمها عشان اتاكد اذا اليوزر دخل الايميل صح او لا
// Route::get('/classrooms/{classroom}/edit',[ClassroomsrController::class,'edit'])
// ->name('classrooms.edit')
// ->where('classroom','\d+');

// Route::put('/classrooms/{classroom}',[ClassroomsrController::class,'update'])
// ->name('classrooms.update')
// ->where('classroom','\d+');

// Route::delete('/classrooms/{classroom}',[ClassroomsrController::class,'destroy'])
// ->name('classrooms.destroy')
// ->where('classroom','\d+');

// Route Model Bindding
// Route::resource('/classrooms', ClassroomsrController::class);
// // ->where(['classroom','\d+']);

// ]);

// Route::resource('classrooms.classworks',ClassworkController::class)
// ->shallow()
// ;




// Route::get('/topics',[TopicController::class,'index'])
// //    لهاد الراوت registerionبمعنى لما اعمل
// //ويستدعيه راح يروح ع الكونترلور راح يروح ع دالة index
// ->name('Topics.index');

// Route::get('/topics/create',[TopicController::class,'create'])
// ->name('Topics.create');

// Route::post('/topics',[TopicController::class,'store'])
// ->name('Topics.store');

// Route::get('/topics/{topic}',[TopicController::class,'show'])
// ->name('topics.show')
// ->where('topics','\d+'); //reqular expersiion

// Route::get('/topics/{topic}/edit',[TopicController::class,'edit'])
// ->name('topics.edit')
// ->where('topics','\d+');

// Route::put('/topics/{topic}',[TopicController::class,'update'])
// ->name('topics.update')
// ->where('topics','\d+');

// Route::delete('/topics/{topics}',[TopicController::class,'destroy'])
// ->name('topics.destroy')
// ->where('topics','\d+');

// Route::get('/classrooms/create',[ClassroomsrController::class,'create'])
// // ->name('classrooms.create');






