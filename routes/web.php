<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Auth;

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

Route::get('cache', function () {

    \Artisan::call('cache:clear');
    \Artisan::call('config:cache');

    dd("Cache is cleared");
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });
    Route::middleware(['auth:admin'])->group(function () {
        // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'], function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


        Route::get('/profile', [App\Http\Controllers\HomeController::class, 'userProfile'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\HomeController::class, 'userProfileSave'])->name('profile.save');
        // Route::get('user/change/password','HomeController@changePassword')->name('user.changepassword');
        Route::post('admin/change/password', [App\Http\Controllers\HomeController::class, 'updateUserPassword'])->name('changepassword.save');

        //-----------------User----------------

        Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
        Route::post('/user/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/update/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
        Route::get('/user/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.delete');
        Route::post('/user/updateStatus', [App\Http\Controllers\Admin\UserController::class, 'updateStatus'])->name('user.updateStatus');

        // ---------------Event---------------------
        Route::get('/event', [App\Http\Controllers\Admin\EventController::class, 'index'])->name('event.index');
        Route::get('/event/create', [App\Http\Controllers\Admin\EventController::class, 'create'])->name('event.create');
        Route::post('/event/store', [App\Http\Controllers\Admin\EventController::class, 'store'])->name('event.store');
        Route::get('/event/edit/{id}', [App\Http\Controllers\Admin\EventController::class, 'edit'])->name('event.edit');
        Route::post('/event/update/{id}', [App\Http\Controllers\Admin\EventController::class, 'update'])->name('event.update');
        Route::get('/event/delete/{id}', [App\Http\Controllers\Admin\EventController::class, 'destroy'])->name('event.delete');

        // ---------------Category--------------------
        Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.index');
        Route::get('/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/store', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/category/update/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/delete/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('category.delete');

        // ---------------Category--------------------
        Route::get('/photo', [App\Http\Controllers\Admin\PhotosController::class, 'index'])->name('photo.index');
        Route::get('/photo/create', [App\Http\Controllers\Admin\PhotosController::class, 'create'])->name('photo.create');
        Route::post('/photo/store', [App\Http\Controllers\Admin\PhotosController::class, 'store'])->name('photo.store');
        Route::get('/photo/edit/{id}', [App\Http\Controllers\Admin\PhotosController::class, 'edit'])->name('photo.edit');
        Route::post('/photo/update/{id}', [App\Http\Controllers\Admin\PhotosController::class, 'update'])->name('photo.update');
        Route::get('/photo/delete/{id}', [App\Http\Controllers\Admin\PhotosController::class, 'destroy'])->name('photo.delete');
    });

});










// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::middleware(['guest:admin'])->group(function () {
//         Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
//         Route::post('/login', [LoginController::class, 'login']);
//     });
//     Route::middleware(['auth:admin'])->group(function () {
//         Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//         Route::get('dashboard', function () {
//             return view('admin.dashboard');
//         })->name('admin.dashboard');
//     });

//     Route::post('/logout', [LoginController::class, 'login']);
//     //-----------------Interest---------------------



// });