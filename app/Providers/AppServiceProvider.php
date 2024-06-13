<?php

namespace App\Providers;

use App\Repositories\Blog\BlogRepository;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\BlogComment\BlogCommentInterface;
use App\Repositories\BlogComment\BlogCommentRepository;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductCategory\ProductCategoryRepository;
use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use App\Repositories\ProductComment\ProductCommentInterface;
use App\Repositories\ProductComment\ProductCommentRepository;
use App\Service\Blog\BlogService;
use App\Service\Blog\BlogServiceInterface;
use App\Service\BlogComment\BlogCommentService;
use App\Service\BlogComment\BlogCommentServiceInterface;
use App\Service\Brand\BrandService;
use App\Service\Brand\BrandServiceInterface;
use App\Service\Order\OrderService;
use App\Service\Order\OrderServiceInterface;
use App\Service\OrderDetail\OrderDetailService;
use App\Service\OrderDetail\OrderDetailServiceInterface;
use App\Service\Product\ProductService;
use App\Service\Product\ProductServiceInterface;
use App\Service\ProductCategory\ProductCategoryService;
use App\Service\ProductCategory\ProductCategoryServiceInterface;
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
        //productcategory
        $this->app->singleton(
          
            ProductCategoryRepositoryInterface::class,
            ProductCategoryRepository::class,
        );
        $this->app->singleton(
         
          ProductCategoryServiceInterface::class ,
          ProductCategoryService::class,
        );
        //Brand
      $this->app->singleton(
          
        BrandRepositoryInterface::class,
        BrandRepository::class,
    );
    $this->app->singleton(
     
      BrandServiceInterface::class ,
      BrandService::class,
    );
      //Order
      $this->app->singleton(
        OrderRepositoryInterface::class ,
        OrderRepository::class,
    );
    $this->app->singleton(
     
      OrderServiceInterface::class ,
      OrderService::class,
    );
    //OrderDetail
    $this->app->singleton(
      OrderDetailRepositoryInterface::class ,
      OrderDetailRepository::class,
  );
  $this->app->singleton(
   
    OrderDetailServiceInterface::class ,
    OrderDetailService::class,
  );
   //blos
   $this->app->singleton(
          
    BlogRepositoryInterface::class,
    BlogRepository::class,
);
$this->app->singleton(
 
  BlogServiceInterface::class ,
  BlogService::class,
);
//BlogComment
$this->app->singleton(
  BlogCommentInterface::class,
  BlogCommentRepository::class,
);
$this->app->singleton(
  BlogCommentServiceInterface::class,
  BlogCommentService::class,
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
