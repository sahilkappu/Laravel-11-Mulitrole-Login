<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/check-user-detail', [LoginController::class, 'validateDetails']);
Route::get('logout', [LoginController::class, 'logout']);

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware(AdminMiddleware::class);
Route::get('/user', [UserController::class, 'index'])->name('user.dashboard')->middleware(UserMiddleware::class);

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/users', [AdminController::class, "getUsers"])->name('users');
    Route::get('user-server-table', [AdminController::class, 'getUserAjaxServerTable'])->name('user.server.table');
    Route::post('/update-user', [AdminController::class, 'postUpdateUser'])->name('update.user');
    Route::post('/change-user-status', [AdminController::class, 'postChangeUserStatus'])->name('change.user.status');
    Route::post('/delete-user', [AdminController::class, "postDeleteuser"])->name('delete.user');
});

Route::middleware([UserMiddleware::class])->group(function () {
    Route::get('/profile', [UserController::class, 'getProfile'])->name('profile');
    Route::post('/update-profile', [UserController::class, 'postUpdateProfile'])->name('update.profile');
});
