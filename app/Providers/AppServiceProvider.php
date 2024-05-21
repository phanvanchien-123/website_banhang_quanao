<?php

namespace App\Providers;

use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductComment\ProductCommentInterface;
use App\Repositories\ProductComment\ProductCommentRepository;
use App\Service\Product\ProductService;
use App\Service\Product\ProductServiceInterface;
use App\Service\ProductComment\ProductCommentService;
use App\Service\ProductComment\ProductCommentServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
        //Product
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
        $this->app->singleton(
          ProductServiceInterface::class,
          ProductService::class 
        );
        //ProductComment
        $this->app->singleton(
            ProductCommentInterface::class,
            ProductCommentRepository::class,
        );
        $this->app->singleton(
            ProductCommentServiceInterface::class,
            ProductCommentService::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
