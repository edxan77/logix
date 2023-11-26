<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileResetController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserImageController;
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

Route::middleware('guest')->group(function () {
    Route::get('/', [IndexController::class, 'index']);

    Route::post('/register', [RegistrationController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/reset/password', [ProfileResetController::class, 'resetPasswordIndex']);
    Route::get('/reset/password/confirm/{token}', [ProfileResetController::class, 'resetPasswordEdit']);
    Route::post('/reset/password/store', [ProfileResetController::class, 'passwordResetStore']);
    Route::post('/reset/password/update', [ProfileResetController::class, 'passwordResetUpdate']);

    Route::get('/reset/email', [ProfileResetController::class, 'resetEmailIndex']);
    Route::get('/reset/email/confirm', [ProfileResetController::class, 'resetEmailEdit']);
    Route::get('/reset/email/sent', [ProfileResetController::class, 'resetEmailSent']);
    Route::post('reset/email/store', [ProfileResetController::class, 'emailResetStore']);
    Route::post('/reset/email/update', [ProfileResetController::class, 'emailResetUpdate']);

    Route::get('/reset/successful', [ProfileResetController::class, 'successfulReset']);
});

Route::middleware('auth')->group(function () {
    Route::post('/user/image/upload', [UserImageController::class, 'store'])->name('upload');
    Route::get('/user/image/upload', [UserImageController::class, 'index']);
    Route::get('/user/images', [UserImageController::class, 'showImages']);

    Route::get('/dashboard', [AccountController::class, 'index']);

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/article', [ArticleController::class, 'index']);
Route::get('/articles', [ArticleController::class, 'all']);
Route::post('/article/store', [ArticleController::class, 'store']);
Route::post('/article/comment/add', [ArticleController::class, 'addComment']);
Route::post('/article/like', [ArticleController::class, 'like']);
