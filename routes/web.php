<?php

use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\materController;
use App\Http\Controllers\Admin;
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

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    // Route::get('',[Admin\HomeController::class,'index']) ->name('admin.home.index');
    Route::get('', function () {
        return view('admin.dashboard.index');
    });
    // Route::get('',[Admin\HomeController::class,'index']) ->name('admin.home.index');
    Route::group(['prefix' => 'category' ] , function () {
        Route::get('',[Admin\CategoryController::class,'index']) ->name('admin.category');
        Route::get('create',[Admin\CategoryController::class,'create']) ->name('admin.category.create');
        Route::post('store',[Admin\CategoryController::class,'store']) ->name('admin.category.store');

        Route::get('edit/{id}',[Admin\CategoryController::class,'edit']) ->name('admin.category.edit');
        Route::post('update/{id}',[Admin\CategoryController::class,'update']) ->name('admin.category.update');

        Route::get('delete/{id}',[Admin\CategoryController::class,'delete']) ->name('admin.category.delete');      
    });

    Route::group(['prefix' => 'product' ] , function () {
        Route::get('',[Admin\ProductController::class,'index']) ->name('admin.product');

        Route::get('create',[Admin\ProductController::class,'create']) ->name('admin.product.create');
        Route::post('store',[Admin\ProductController::class,'store']) ->name('admin.product.store');

        Route::get('edit/{id}',[Admin\ProductController::class,'edit']) ->name('admin.product.edit');
        Route::post('update/{id}',[Admin\ProductController::class,'update']) ->name('admin.product.update');

        Route::get('delete/{id}',[Admin\ProductController::class,'delete']) ->name('admin.product.delete');      
    });

    Route::group(['prefix' => 'user' ] , function () {
        Route::get('',[Admin\UserController::class,'index']) ->name('admin.user');

        
        Route::get('create',[Admin\UserController::class,'create']) ->name('admin.user.create');
        Route::post('store',[Admin\UserController::class,'store']) ->name('admin.user.store');

        Route::get('edit/{id}',[Admin\UserController::class,'edit']) ->name('admin.user.edit');
        Route::post('update/{id}',[Admin\UserController::class,'update']) ->name('admin.user.update');

        Route::get('delete/{id}',[Admin\UserController::class,'delete']) ->name('admin.user.delete');      
    });

    Route::group(['prefix' => 'profile' ] , function () {
        Route::get('/{id}',[Admin\ProfileController::class,'show']) ->name('admin.profile.show');
        Route::get('/updatePass/{id}',[Admin\ProfileController::class,'updatePass']) ->name('admin.profile.updatePass');
        Route::post('/updatePass/{id}',[Admin\ProfileController::class,'update']);
    });

    Route::group(['prefix' => 'role'] , function () {
        Route::get('',[Admin\RoleController::class,'index']) ->name('admin.role');

        
        Route::get('create',[Admin\RoleController::class,'create']) ->name('admin.role.create');
        Route::post('store',[Admin\RoleController::class,'store']) ->name('admin.role.store');

        Route::get('edit/{id}',[Admin\RoleController::class,'edit']) ->name('admin.role.edit');
        Route::post('update/{id}',[Admin\RoleController::class,'update']) ->name('admin.role.update');

        Route::get('delete/{id}',[Admin\RoleController::class,'delete']) ->name('admin.role.delete');      
    });
});




















































