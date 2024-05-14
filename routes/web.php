<?php

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

Route::group(['namespace' => 'Backend', 'prefix' => 'admin'], function () {
    // Route::get('',[Backend\HomeController::class,'index']) ->name('admin.home.index');
    Route::get('', function () {
        return view('admin.dashboard.index');
    });
    // Route::get('',[Backend\HomeController::class,'index']) ->name('admin.home.index');


    Route::group(['prefix' => 'category' ] , function () {
        Route::get('',[Backend\CategoryController::class,'index']) ->name('admin.category.index');
        Route::get('create',[Backend\CategoryController::class,'create']) ->name('admin.category.create');
        Route::post('store',[Backend\CategoryController::class,'store']) ->name('admin.category.store');

        Route::get('edit/{id}',[Backend\CategoryController::class,'edit']) ->name('admin.category.edit');
        Route::post('update/{id}',[Backend\CategoryController::class,'update']) ->name('admin.category.update');

        Route::get('delete/{id}',[Backend\CategoryController::class,'delete']) ->name('admin.category.delete');      
    });

    Route::group(['prefix' => 'product' ] , function () {
        Route::get('',[Backend\ProductController::class,'index']) ->name('admin.product.index');

        Route::get('create',[Backend\ProductController::class,'create']) ->name('admin.product.create');
        Route::post('store',[Backend\ProductController::class,'store']) ->name('admin.product.store');

        Route::get('edit/{id}',[Backend\ProductController::class,'edit']) ->name('admin.product.edit');
        Route::post('update/{id}',[Backend\ProductController::class,'update']) ->name('admin.product.update');

        Route::get('delete/{id}',[Backend\ProductController::class,'delete']) ->name('admin.product.delete');      
    });

    Route::group(['prefix' => 'user' ] , function () {
        Route::get('',[Backend\UserController::class,'index']) ->name('admin.user.index');

        
        Route::get('create',[Backend\UserController::class,'create']) ->name('admin.user.create');
        Route::post('store',[Backend\UserController::class,'store']) ->name('admin.user.store');

        Route::get('edit/{id}',[Backend\UserController::class,'edit']) ->name('admin.user.edit');
        Route::post('update/{id}',[Backend\UserController::class,'update']) ->name('admin.user.update');

        Route::get('delete/{id}',[Backend\UserController::class,'delete']) ->name('admin.user.delete');      
    });

    Route::group(['prefix' => 'profile' ] , function () {
        Route::get('/{id}',[Backend\ProfileController::class,'show']) ->name('admin.profile.show');
        Route::get('/updatePass/{id}',[Backend\ProfileController::class,'updatePass']) ->name('admin.profile.updatePass');
        Route::post('/updatePass/{id}',[Backend\ProfileController::class,'update']);
    });

    Route::group(['prefix' => 'role','middleware' => ['role:System'] ] , function () {
        Route::get('',[Backend\RoleController::class,'index']) ->name('admin.role.index');

        
        Route::get('create',[Backend\RoleController::class,'create']) ->name('admin.role.create');
        Route::post('store',[Backend\RoleController::class,'store']) ->name('admin.role.store');

        Route::get('edit/{id}',[Backend\RoleController::class,'edit']) ->name('admin.role.edit');
        Route::post('update/{id}',[Backend\RoleController::class,'update']) ->name('admin.role.update');

        Route::get('delete/{id}',[Backend\RoleController::class,'delete']) ->name('admin.role.delete');      
    });
});




















































