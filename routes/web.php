<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomingMailController;
use App\Http\Controllers\OutgoingMailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    Route::prefix('user')->as('user.')->middleware('roles')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('edit');
        Route::post('update/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('delete/{user}', [UserController::class, 'destroy'])->name('delete');
    });

    Route::get('profile', [UserController::class, 'profile'])->name('profile');

    Route::resource('incoming-mail', IncomingMailController::class);
    Route::prefix('incoming-mail')->as('incoming-mail.')->group(function () {
        Route::post('/store/media', [IncomingMailController::class, 'storeMedia'])->name('storeMedia');
    });

    Route::resource('outgoing-mail', OutgoingMailController::class);
    Route::prefix('outgoing-mail')->as('outgoing-mail.')->group(function () {
        Route::post('/store/media', [OutgoingMailController::class, 'storeMedia'])->name('storeMedia');
    });
});
