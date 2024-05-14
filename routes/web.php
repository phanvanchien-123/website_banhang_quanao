<?php

use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\materController;
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

Route::get('/',[materController::class,'index']);
Route::middleware('auth')->group(function(){
    Route::prefix('my_account')->group(function(){
        Route::prefix('dashboard')->group(function(){
            Route::get('/',[AccountController::class,'index'])->name('dashboard.index');
        });
    });
});
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




















































