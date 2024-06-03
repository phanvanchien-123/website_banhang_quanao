<?php

use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\materController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Client\ShopController;
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
Route::prefix('/shop')->group(function(){
        Route::get('',[ShopController::class,'index'])->name('client.shop.index');
        Route::get('/details/{id}',[ShopController::class,'show'])->name('Client.shop.show');
        Route::post('/details/{id}/Comment',[ShopController::class,'postComment'])->name('Client.Comment');
      
       Route::post('/details/{id}',[ShopController::class,'show'])->name('Client.shop.show');
});

Route::middleware('auth')->group(function(){
    Route::prefix('my_account')->group(function(){
        Route::prefix('dashboard')->group(function(){
            Route::get('/',[AccountController::class,'index'])->name('dashboard.index');
        });
    });
});
Auth::routes();

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' =>'auth'], function () {
    Route::get('home',[Admin\HomeController::class,'index']) ->name('admin.home.index');

    Route::group(['prefix' => 'blog' ] , function () {
        Route::get('',[Admin\BlogController::class,'index']) ->name('admin.blog.index');

        Route::get('create',[Admin\BlogController::class,'create']) ->name('admin.blog.create');
        Route::post('store',[Admin\BlogController::class,'store']) ->name('admin.blog.store');

        Route::get('edit/{id}',[Admin\BlogController::class,'edit']) ->name('admin.blog.edit');
        Route::post('update/{id}',[Admin\BlogController::class,'update']) ->name('admin.blog.update');

        Route::get('delete/{id}',[Admin\BlogController::class,'delete']) ->name('admin.blog.delete');

        Route::get('cmt',[Admin\BlogController::class,'cmt']) ->name('admin.blog.cmt');
        Route::patch('cmt/{id}', [Admin\BlogController::class, 'updateCmt'])->name('admin.blog.updateCmt');  


    });
    
    Route::group(['prefix' => 'category' ] , function () {
        Route::get('',[Admin\CategoryController::class,'index']) ->name('admin.category.index');
        Route::get('create',[Admin\CategoryController::class,'create']) ->name('admin.category.create');
        Route::post('store',[Admin\CategoryController::class,'store']) ->name('admin.category.store');
        Route::get('edit/{id}',[Admin\CategoryController::class,'edit']) ->name('admin.category.edit');
        Route::post('update/{id}',[Admin\CategoryController::class,'update']) ->name('admin.category.update');

        Route::get('delete/{id}',[Admin\CategoryController::class,'delete']) ->name('admin.category.delete');      
    });

    Route::group(['prefix' => 'product' ] , function () {
        Route::get('',[Admin\ProductController::class,'index']) ->name('admin.product.index');

        Route::get('create',[Admin\ProductController::class,'create']) ->name('admin.product.create');
        Route::post('store',[Admin\ProductController::class,'store']) ->name('admin.product.store');

        Route::get('edit/{id}',[Admin\ProductController::class,'edit']) ->name('admin.product.edit');
        Route::post('update/{id}',[Admin\ProductController::class,'update']) ->name('admin.product.update');

        Route::get('delete/{id}',[Admin\ProductController::class,'delete']) ->name('admin.product.delete');   

        Route::get('cmt',[Admin\ProductController::class,'cmt']) ->name('admin.product.cmt');
        Route::patch('cmt/{id}', [Admin\ProductController::class, 'updateCmt'])->name('admin.product.updateCmt');  
      
    });

    Route::group(['prefix' => 'brand' ] , function () {
        Route::get('',[Admin\BrandController::class,'index']) ->name('admin.brand.index');

        Route::get('create',[Admin\BrandController::class,'create']) ->name('admin.brand.create');
        Route::post('store',[Admin\BrandController::class,'store']) ->name('admin.brand.store');

        Route::get('edit/{id}',[Admin\BrandController::class,'edit']) ->name('admin.brand.edit');
        Route::post('update/{id}',[Admin\BrandController::class,'update']) ->name('admin.brand.update');

        Route::get('delete/{id}',[Admin\BrandController::class,'delete']) ->name('admin.brand.delete');      
    });

    Route::group(['prefix' => 'user' ] , function () {
        Route::get('',[Admin\UserController::class,'index']) ->name('admin.user.index');

        
        Route::get('create',[Admin\UserController::class,'create']) ->name('admin.user.create');
        Route::post('store',[Admin\UserController::class,'store']) ->name('admin.user.store');

        Route::get('edit/{id}',[Admin\UserController::class,'edit']) ->name('admin.user.edit');
        Route::post('update/{id}',[Admin\UserController::class,'update']) ->name('admin.user.update');

        Route::get('delete/{id}',[Admin\UserController::class,'delete']) ->name('admin.user.delete');      
    });

    Route::group(['prefix' => 'profile'], function() {

        Route::get('', [Admin\ProfileController::class, 'index'])->name('admin.profile.index');
        
        // Route::get('update', [Admin\ProfileController::class, 'edit']) ;
        Route::post('update', [Admin\ProfileController::class, 'update'])->name('admin.profile.update');
        Route::get('changePassword', [Admin\ProfileController::class, 'changePassword']) ->name('admin.profile.changePassword');

    });

    Route::group(['prefix' => 'role'] , function () {
        Route::get('',[Admin\RoleController::class,'index']) ->name('admin.role.index');

        
        Route::get('create',[Admin\RoleController::class,'create']) ->name('admin.role.create');
        Route::post('store',[Admin\RoleController::class,'store']) ->name('admin.role.store');

        Route::get('edit/{id}',[Admin\RoleController::class,'edit']) ->name('admin.role.edit');
        Route::post('update/{id}',[Admin\RoleController::class,'update']) ->name('admin.role.update');

        Route::get('delete/{id}',[Admin\RoleController::class,'delete']) ->name('admin.role.delete');
    });
});




















































