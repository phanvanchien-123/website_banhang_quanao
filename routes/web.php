<?php

use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\materController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Client;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckOutController;
use App\Http\Controllers\Client\CouponController;
use App\Http\Controllers\Client\HomeController;
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

Route::get('/',[HomeController::class,'index'])->name('home');

Route::prefix('/shop')->group(function(){
        Route::get('',[ShopController::class,'index'])->name('client.shop.index');
        Route::get('/details/{id}',[ShopController::class,'show'])->name('Client.shop.show');
        Route::post('/details/{id}/Comment',[ShopController::class,'postComment'])->name('Client.Comment');
       Route::post('/details/{id}',[ShopController::class,'show'])->name('Client.shop.show');
       Route::get('category/{categoryName}',[ShopController::class,'category']);
       Route::get('/details/{id}/sizes', [ShopController::class, 'getSizesByColor'])->name('shop.details.sizes');
});
Route::prefix('/blog')->group(function(){
    Route::get('',[BlogController::class,'index'])->name('blog.index');
    Route::get('/{id}',[BlogController::class,'show']);
    Route::post('/{id}/Comment',[BlogController::class,'postComment']);
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('Cart')->group(function (){
        Route::get('',[CartController::class,'index']);
        Route::post('add/{id}',[CartController::class,'add'])->name('cart.add'); 
        Route::post('update/{id}',[CartController::class,'update'])->name('cart.update'); 
        Route::delete('delete/{id}',[CartController::class,'delete'])->name('cart.delete');
        Route::post('clear',[CartController::class,'clearCart'])->name('cart.clearCart');
        Route::post('orderSelected', [CartController::class,'orderSelected'])->name('cart.orderSelected');


    });
    Route::prefix('checkout')->group(function(){
        Route::get('',[CheckOutController::class,'index'])->name('list');
        Route::post('/',[CheckOutController::class,'addOrder']);
        Route::post('/vnPayCheck',[CheckOutController::class,'vnPayCheck'])->name('vnPayCheck.index');
        Route::get('/Vnpay',[CheckOutController::class,'returnVNPay']);
    });

});
Route::prefix('voucher_discount')->group(function(){
    Route::get('/',[CouponController::class,'index'])->name('index.coupon');
    Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon');
    Route::post('/remove-coupon', [CouponController::class, 'removeCoupon'])->name('remove.coupon');
});

Route::middleware('auth')->group(function(){
    Route::prefix('my_account')->group(function(){
        Route::prefix('dashboard')->group(function(){
            Route::get('/',[AccountController::class,'index'])->name('dashboard.index');
            Route::get('{id}',[AccountController::class,'show']);
            Route::delete('/cancel_order/{id}', [AccountController::class, 'cancelOrder'])->name('order.cancel');
            Route::post('/reorder/{id}', [AccountController::class, 'reorder'])->name('order.reorder');

        });
    });
});
Auth::routes();

Route::group(['prefix' => 'auth' ], function ($router) {
    Route::get('/google', [App\Http\Controllers\Auth\LoginGoogleController::class,'redirectToGoogle'])->name('auth.google');
    Route::get('/google/callback', [App\Http\Controllers\Auth\LoginGoogleController::class,'handleGoogleCallback']);

});

Route::namespace('Admin')->prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('home',[Admin\HomeController::class,'index']) ->name('admin.home.index');
    // Route::get('cashier',[Admin\CashierController::class,'index']) ->name('admin.cashier.index');

    Route::get('/notifications', [Admin\NotificationController::class, 'fetch'])->name('notifications.fetch');

    Route::group(['prefix' => 'cashier' ] , function () {
        Route::get('',[Admin\CashierController::class,'index']) ->name('admin.cashier.index');

        Route::get('/search-product', [Admin\CashierController::class,'searchProduct']);
        Route::get('/product-details/{id}', [Admin\CashierController::class,'getProductDetails']);

        Route::post('/print-invoice', [Admin\CashierController::class, 'printInvoice'])->name('cashier.print-invoice');   
    });

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

    Route::group(['prefix' => 'brand' ] , function () {
        Route::get('',[Admin\BrandController::class,'index']) ->name('admin.brand.index');

        Route::get('create',[Admin\BrandController::class,'create']) ->name('admin.brand.create');
        Route::post('store',[Admin\BrandController::class,'store']) ->name('admin.brand.store');

        Route::get('edit/{id}',[Admin\BrandController::class,'edit']) ->name('admin.brand.edit');
        Route::post('update/{id}',[Admin\BrandController::class,'update']) ->name('admin.brand.update');

        Route::get('delete/{id}',[Admin\BrandController::class,'delete']) ->name('admin.brand.delete');      
    });

    Route::group(['prefix' => 'coupon' ] , function () {
        Route::get('',[Admin\CouponController::class,'index']) ->name('admin.coupon.index');
        Route::get('create',[Admin\CouponController::class,'create']) ->name('admin.coupon.create');
        Route::post('store',[Admin\CouponController::class,'store']) ->name('admin.coupon.store');

        Route::get('edit/{id}',[Admin\CouponController::class,'edit']) ->name('admin.coupon.edit');
        Route::post('update/{id}',[Admin\CouponController::class,'update']) ->name('admin.coupon.update');

        Route::get('delete/{id}',[Admin\CouponController::class,'delete']) ->name('admin.coupon.delete');

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

        Route::get('stock',[Admin\ProductController::class,'stock']) ->name('admin.product.stock');


        Route::get('cmt',[Admin\ProductController::class,'cmt']) ->name('admin.product.cmt');
        Route::patch('cmt/{id}', [Admin\ProductController::class, 'updateCmt'])->name('admin.product.updateCmt');  
      
    });

    Route::group(['prefix' => 'analytics' ] , function () {
        Route::get('',[Admin\AnalyticsController::class,'index']) ->name('admin.analytics.index');    
    });

    Route::group(['prefix' => 'order' ] , function () {
        Route::get('',[Admin\OrderController::class,'index']) ->name('admin.order.index');

        Route::get('show/{id}',[Admin\OrderController::class,'show']) ->name('admin.order.show');

        Route::patch('update/{id}',[Admin\OrderController::class,'update']) ->name('admin.order.update');

        Route::get('delete/{id}',[Admin\OrderController::class,'delete']) ->name('admin.order.delete');      
    });

    Route::group(['prefix' => 'user' ] , function () {
        Route::get('',[Admin\UserController::class,'index']) ->name('admin.user.index');

        
        Route::get('create',[Admin\UserController::class,'create']) ->name('admin.user.create');
        Route::post('store',[Admin\UserController::class,'store']) ->name('admin.user.store');

        Route::get('edit/{id}',[Admin\UserController::class,'edit']) ->name('admin.user.edit');
        Route::post('update/{id}',[Admin\UserController::class,'update']) ->name('admin.user.update');

        Route::get('delete/{id}',[Admin\UserController::class,'delete']) ->name('admin.user.delete');      
    });

    Route::group(['prefix' => 'supplier' ] , function () {
        Route::get('',[Admin\SupplierController::class,'index']) ->name('admin.supplier.index');

        Route::get('create',[Admin\SupplierController::class,'create']) ->name('admin.supplier.create');
        Route::post('store',[Admin\SupplierController::class,'store']) ->name('admin.supplier.store');

        Route::get('edit/{id}',[Admin\SupplierController::class,'edit']) ->name('admin.supplier.edit');
        Route::post('update/{id}',[Admin\SupplierController::class,'update']) ->name('admin.supplier.update');

        Route::get('delete/{id}',[Admin\SupplierController::class,'delete']) ->name('admin.supplier.delete');      
    });

    Route::group(['prefix' => 'profile'], function() {

        Route::get('', [Admin\ProfileController::class, 'index'])->name('admin.profile.index');
        
        // Route::get('update', [Admin\ProfileController::class, 'edit']) ;
        Route::patch('update', [Admin\ProfileController::class, 'update'])->name('admin.profile.update');
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

    Route::group(['prefix' => 'display'] , function () {
        Route::get('',[Admin\DisplayController::class,'index']) ->name('admin.display.index');
        Route::post('/creatrOrUpdateLogo',[Admin\DisplayController::class,'creatrOrUpdateLogo']) ->name('admin.display.creatrOrUpdateLogo');
        Route::post('/creatrOrUpdateFlink',[Admin\DisplayController::class,'creatrOrUpdateFlink']) ->name('admin.display.creatrOrUpdateFlink');
        Route::delete('/footerLink/delete/{id}', [App\Http\Controllers\Admin\DisplayController::class, 'deleteFooter'])->name('admin.footer.delete');

        Route::group(['prefix' => 'slide'] , function () {
            Route::get('',[Admin\DisplayController::class,'index']) ->name('admin.slide.index');
    
            
            Route::get('create',[Admin\DisplayController::class,'createSlide']) ->name('admin.slide.create');
            Route::post('store',[Admin\DisplayController::class,'storeSlide']) ->name('admin.slide.store');
    
            Route::get('edit/{id}',[Admin\DisplayController::class,'editSlide']) ->name('admin.slide.edit');
            Route::post('update/{id}',[Admin\DisplayController::class,'updateSlide']) ->name('admin.slide.update');
    
            Route::get('delete/{id}',[Admin\DisplayController::class,'deleteSlide']) ->name('admin.slide.delete');
        });
    });
  
});

Route::group(['prefix' => 'PayOS'], function(){
    Route::post('/QRpayment', [Client\PayOSController::class, 'createPayment' ])->name('qrpayment');
    Route::get('/success', [Client\PayOSController::class, 'success'])->name('QRsuccess');
    Route::post('/handleWebhook', [Client\PayOSController::class, 'handleWebhook'])->name('handleWebhook');
});

