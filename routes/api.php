<?php

use App\Http\Controllers\Api\v1\ClassroomsController;
use App\Http\Controllers\Api\v1\ClassworkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function(){

  Route:: middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request){
        return $request->user();


    });

    Route::apiResource('/classrooms',ClassroomsController ::class);
Route::apiResource('/classrooms.classworks',ClassworkController ::class);
});
// بتستني edit ,update,delete

// Route:: middleware('guest:sanctum')->group(function(){
//     Route::post('auth\sanctum')


// });


});

