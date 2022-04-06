<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
|
*/




Route::middleware('auth:api')->get('/user', function (Request $request) {
    // return $request->user();
    // Route::post('storeBlog', 'Api\BlogController@store');
    Route::post('/user/register', [App\Http\Controllers\Api\UserController::class, 'registerApi']);
});

Route::post('/user/register', [App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('/user/login', [App\Http\Controllers\Api\UserController::class, 'login']);
Route::post('/user/social/login', [App\Http\Controllers\Api\UserController::class, 'socialLogin']);
Route::get('/user/details/{id}', [App\Http\Controllers\Api\UserController::class, 'show']);
Route::post('/user/update', [App\Http\Controllers\Api\UserController::class, 'update']);
Route::post('/user/change-password', [App\Http\Controllers\Api\UserController::class, 'changePassword']);

// ----------------Updates------------------
Route::get('/updates', [App\Http\Controllers\Api\UpdatesController::class, 'index']);
Route::post('/updates/store', [App\Http\Controllers\Api\UpdatesController::class, 'store']);

// ------------------Event-------------------------

Route::get('/event/list', [App\Http\Controllers\Api\EventController::class, 'index']);
Route::get('/event/details/{eventId}', [App\Http\Controllers\Api\EventController::class, 'show']);
Route::post('/event/store', [App\Http\Controllers\Api\EventController::class, 'store']);


// -----------------Category-----------------------
Route::get('/category/list', [App\Http\Controllers\Api\CategoryController::class, 'index']);
Route::post('/category/store', [App\Http\Controllers\Api\CategoryController::class, 'store']);

// -----------------Photos------------------------
Route::get('/photo/list/{categoryId}', [App\Http\Controllers\Api\PhotosController::class, 'index']);
Route::post('/photo/store', [App\Http\Controllers\Api\PhotosController::class, 'store']);

// -----------------Governing Bodies---------------
Route::get('/governing/list', [App\Http\Controllers\Api\GoverningController::class, 'index']);
Route::post('/governing/store', [App\Http\Controllers\Api\GoverningController::class, 'store']);

// ------------------Prayer-------------------------
Route::get('/prayer/list', [App\Http\Controllers\Api\PrayerController::class, 'index']);
Route::post('/prayer/store', [App\Http\Controllers\Api\PrayerController::class, 'store']);

// ----------------Download--------------------------
Route::get('/document/list', [App\Http\Controllers\Api\DocumentController::class, 'index']);
Route::post('/document/store', [App\Http\Controllers\Api\DocumentController::class, 'store']);


// -----------------Image Upload----------------------
Route::post('/image/upload', [App\Http\Controllers\Api\ImageController::class, 'store']);

// -----------------Notification----------------------
Route::get('/notification/{id}', [App\Http\Controllers\Api\NotificationController::class, 'userWiseNotification']);