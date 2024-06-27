@extends('layouts.master')

@section('content')
    {{-- <link rel="stylesheet" href="{{asset('/assets/plugins/jquery-ui.css')}}">
<link rel="stylesheet" href="{{asset('/assets/plugins/magnific-popup.css')}}">
<link rel="stylesheet" href="{{asset('/assets/plugins/perfect-scrollbar.css')}}">
<link rel="stylesheet" href="{{asset('/assets/plugins/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/plugins/slick.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/normalize.css')}}">
<link rel="stylesheet" href="{{asset('/assets/vendors/uicons-regular-straight.css')}}"> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <style>
        .container1 {
         position: relative;
         left: 100px;
        }
    </style>
    <section class="home-slider position-relative pt-50">
        <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
            @foreach ($slide as $item)
            <div class="single-hero-slider single-animation-wrap">
         
                <div class="container1">
                    <div class="row align-items-center slider-animated-1">
                        <div class="col-lg-4 col-md-5">
                            <div class="hero-slider-content-2">
                               {!!$item->title!!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="single-slider-img single-slider-img-1">
                                <img class="animated slider-1-1" src="{{ asset('storage/' . $item->path) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                       
                            
                        @endforeach
        </div>
        <div class="slider-arrow hero-slider-1-arrow"></div>
    </section>
   
    <!-- banner section start -->
    <section class="featured section-padding position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="assets/imgs/theme/icons/feature-1.png" alt="">
                        <h4 class="bg-1">Free Shipping</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="assets/imgs/theme/icons/feature-2.png" alt="">
                        <h4 class="bg-3">Online Order</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="assets/imgs/theme/icons/feature-3.png" alt="">
                        <h4 class="bg-2">Save Money</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="assets/imgs/theme/icons/feature-4.png" alt="">
                        <h4 class="bg-4">Promotions</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="assets/imgs/theme/icons/feature-5.png" alt="">
                        <h4 class="bg-5">Happy Sell</h4>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                    <div class="banner-features wow fadeIn animated hover-up">
                        <img src="assets/imgs/theme/icons/feature-6.png" alt="">
                        <h4 class="bg-6">24/7 Support</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner section end -->

    <section class="ratio_asos overflow-hidden">
        <div class="container p-sm-0">
            <div class="row m-0">
                <div class="col-12 p-0">

                </div>
            </div>
            <style>
                .r-price {
                    display: flex;
                    flex-direction: row;
                    gap: 20px;
                }

                .r-price .main-price {
                    width: 100%;
                }

                .r-price .rating {
                    padding-left: auto;
                }

                .product-style-3.product-style-chair .product-title {
                    text-align: left;
                    width: 100%;
                }

                @media (max-width:600px) {

                    .product-box p,
                    .product-box a {
                        text-align: left;
                    }

                    .product-style-3.product-style-chair .main-price {
                        text-align: right !important;
                    }

                }
            </style>
            <!-- category section start -->
            <section class="product-tabs section-padding position-relative wow fadeIn animated">
                <div class="bg-square"></div>
                <div class="container">
                    <div class="tab-header">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab"
                                    data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one"
                                    aria-selected="true">Sản phẩm nổi bật</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two"
                                    type="button" role="tab" aria-controls="tab-two" aria-selected="false">Sản Phẩm
                                    SALE Trên 30%</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab"
                                    data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three"
                                    aria-selected="false">Sản Phẩm Mới</button>
                            </li>
                        </ul>
                        <a href="/shop" class="view-more d-none d-md-flex">View More<i
                                class="fi-rs-angle-double-small-right"></i></a>
                    </div>
                    <!--End nav-tabs-->
                    <div class="tab-content wow fadeIn animated" id="myTabContent">
                        <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                            <div class="row product-grid-4">
                                @foreach ($featuredProducts as $item)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="product-details.html">
                                                        <img class="default-img"
                                                            src="{{ asset('storage/' . $item->avatar) }}" alt="">
                                                        <img class="hover-img" src="{{ asset('storage/' . $item->avatar) }}"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn hover-up"
                                                        href="/shop/details/{{ $item->id }}"><i
                                                            class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                        href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                </div>
                                                @if ($item->discount != null)
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">HOT</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a
                                                        href="/shop/details/{{ $item->id }}">{{ $item->productCategory->name }}</a>
                                                </div>
                                                <h2><a href="/shop/details/{{ $item->id }}">{{ $item->name }}</a>
                                                </h2>
                                                <div class="label-section">
                                                    {{-- <span class="badge badge-grey-color">#1 Best seller</span>
                                            <span class="label-text">in fashion</span> --}}
                                                    <ul class="rating my-2 d-inline-block">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $item->avgRating)
                                                                <li>
                                                                    <i class="fas fa-star theme-color"></i>
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <i class="fas fa-star "></i>
                                                                </li>
                                                            @endif
                                                        @endfor
                                                        <li>
                                                            (<span>{{ count($item->productComments) }}</span>)
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    @if ($item->discount)
                                                        <span> {{ number_format($item->discount, 3) }} VND </span>
                                                        <span class="old-price">{{ number_format($item->price, 3) }}
                                                            VND</span>
                                                    @else
                                                        <span>{{ number_format($item->price, 3) }} VND</span>
                                                    @endif

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                            <!--End product-grid-4-->
                        </div>
                        <!--En tab one (Featured)-->
                        <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                            <div class="row product-grid-4">
                                @foreach ($ProductsDiscountedOver30 as $item)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="product-details.html">
                                                        <img class="default-img"
                                                            src="{{ asset('storage/' . $item->avatar) }}" alt="">
                                                        <img class="hover-img"
                                                            src="{{ asset('storage/' . $item->avatar) }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn hover-up"
                                                        href="/shop/details/{{ $item->id }}"><i
                                                            class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                        href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                </div>
                                                @if ($item->discount / $item->price < 0.7)
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">SALE
                                                            {{ round((($item->price - $item->discount) / $item->price) * 100) }}%</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a
                                                        href="/shop/details/{{ $item->id }}">{{ $item->productCategory->name }}</a>
                                                </div>
                                                <h2><a href="/shop/details/{{ $item->id }}">{{ $item->name }}</a>
                                                </h2>
                                                <div class="label-section">
                                                    {{-- <span class="badge badge-grey-color">#1 Best seller</span>
                                            <span class="label-text">in fashion</span> --}}
                                                    <ul class="rating my-2 d-inline-block">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $item->avgRating)
                                                                <li>
                                                                    <i class="fas fa-star theme-color"></i>
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <i class="fas fa-star "></i>
                                                                </li>
                                                            @endif
                                                        @endfor
                                                        <li>
                                                            (<span>{{ count($item->productComments) }}</span>)
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    @if ($item->discount)
                                                        <span> {{ number_format($item->discount, 3) }} VND </span>
                                                        <span class="old-price">{{ number_format($item->price, 3) }}
                                                            VND</span>
                                                    @else
                                                        <span>{{ number_format($item->price, 3) }} VND</span>
                                                    @endif

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                            <!--End product-grid-4-->
                        </div>
                        <!--En tab two (Popular)-->
                        <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                            <div class="row product-grid-4">
                                @foreach ($latestProducts as $item)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="product-details.html">
                                                        <img class="default-img"
                                                            src="{{ asset('storage/' . $item->avatar) }}" alt="">
                                                        <img class="hover-img"
                                                            src="{{ asset('storage/' . $item->avatar) }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn hover-up"
                                                        href="/shop/details/{{ $item->id }}"><i
                                                            class="fi-rs-eye"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                        href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                </div>
                                                @if ($item->discount != null)
                                                    <div class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">SALE</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a
                                                        href="/shop/details/{{ $item->id }}">{{ $item->productCategory->name }}</a>
                                                </div>
                                                <h2><a href="/shop/details/{{ $item->id }}">{{ $item->name }}</a>
                                                </h2>
                                                <div class="label-section">
                                                    {{-- <span class="badge badge-grey-color">#1 Best seller</span>
                                            <span class="label-text">in fashion</span> --}}
                                                    <ul class="rating my-2 d-inline-block">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $item->avgRating)
                                                                <li>
                                                                    <i class="fas fa-star theme-color"></i>
                                                                </li>
                                                            @else
                                                                <li>
                                                                    <i class="fas fa-star "></i>
                                                                </li>
                                                            @endif
                                                        @endfor
                                                        <li>
                                                            (<span>{{ count($item->productComments) }}</span>)
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    @if ($item->discount)
                                                        <span> {{ number_format($item->discount, 3) }} VND </span>
                                                        <span class="old-price">{{ number_format($item->price, 3) }}
                                                            VND</span>
                                                    @else
                                                        <span>{{ number_format($item->price, 3) }} VND</span>
                                                    @endif

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!--End product-grid-4-->
                        </div>
                        <!--En tab three (New added)-->
                    </div>
                    <!--End tab-content-->
                </div>
            </section>

        </div>
    </section>

    <section class="category-section ratio_40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title title-2 text-center">
                        <h2>Danh mục của chúng tôi</h2>
                        <h5 class="text-color">Bộ sưu tập của chúng tôi</h5>
                    </div>
                </div>
            </div>
            <div class="row gy-3">
                <div class="col-xxl-2 col-lg-3">
                    <div class="category-wrap category-padding category-block theme-bg-color">
                        <div>
                            <h2 class="light-text"></h2>
                            <h2 class="top-spacing"></h2>
                            <span>Danh Mục</span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9">
                    <div class="category-wrapper category-slider1 white-arrow category-arrow">
                        @foreach ($category as $item)
                            <div>
                                <a href="/shop/category/{{ $item->name }}" class="category-wrap category-padding">
                                    <img src="{{ asset('storage/' . $item->avatar) }}" class="bg-img blur-up lazyload"
                                        alt="category image">
                                    <div class="category-content category-text-1">

                                        <h3 class="theme-color">{{ $item->name }}</h3>
                                        {{-- <span class="text-dark">Fashion</span> --}}
                                    </div>
                                </a>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="banners mb-15">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow fadeIn animated">
                        <img src="assets/imgs/banner/banner-1.png" alt="">
                        <div class="banner-text">
                            <span>Smart Offer</span>
                            <h4>Save 20% on <br>Woman Bag</h4>
                            <a href="shop.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow fadeIn animated">
                        <img src="assets/imgs/banner/banner-2.png" alt="">
                        <div class="banner-text">
                            <span>Sale off</span>
                            <h4>Great Summer <br>Collection</h4>
                            <a href="shop.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-md-none d-lg-flex">
                    <div class="banner-img wow fadeIn animated  mb-sm-0">
                        <img src="assets/imgs/banner/banner-3.png" alt="">
                        <div class="banner-text">
                            <span>New Arrivals</span>
                            <h4>Shop Today’s <br>Deals & Offers</h4>
                            <a href="shop.html">Shop Now <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-20"><span>Sản Phẩm Được Nhiều Người Xem </h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
                <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                    @foreach ($productsview as $item)
                    <div class="product-cart-wrap small hover-up">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="product-details.html">
                                    <img class="default-img" src="{{asset('storage/'.$item->avatar)}}" alt="">
                                    <img class="hover-img" src="{{asset('storage/'.$item->avatar)}}" alt="">
                                </a>
                            </div>
                            <div class="product-action-1">
                                <a aria-label="Quick view" class="action-btn small hover-up" href="/shop/details/{{$item->id}}">
                                    <i class="fi-rs-eye"></i></a>
                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                            </div>
                            @if ($item->discount !=null)
                            <div class="product-badges product-badges-position product-badges-mrg">
                                <span class="hot">SALE</span>
                            </div>
                            @endif
                        </div>
                        <div class="product-content-wrap">
                            <div class="product-category">
                                <a href="shop.html">{{$item->productCategory->name}}</a>
                            </div>
                            <h2><a href="product-details.html">{{$item->name}}</a></h2>
                            <div class="label-section">
                                {{-- <span class="badge badge-grey-color">#1 Best seller</span>
                                <span class="label-text">in fashion</span> --}}
                                <ul class="rating my-2 d-inline-block">
                                    @for($i =1 ;$i<=5;$i++)
                                     @if($i <=$item->avgRating)
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        @else
                                        <li>
                                            <i class="fas fa-star "></i>
                                        </li>
                                        @endif
                                        @endfor
                                        <li>
                                            (<span>{{count($item->productComments)}}</span>)
                                        </li>
                                </ul>
                            </div>
                            <div class="product-price">
                                @if ($item->discount)
                               <span>  {{number_format($item->discount,3)}} VND </span>
                               <span class="old-price">{{number_format($item->price,3)}} VND</span>                
                                  
                                  @else
                                <span>{{number_format($item->price,3)}} VND</span>
                                  @endif
                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    <!--End product-cart-wrap-2-->
                  
                    <!--End product-cart-wrap-2-->
                </div>
            </div>
        </div>
    </section>


    <section class="section-padding">
        <div class="container">
            <h3 class="section-title mb-20 wow fadeIn animated"><span>Featured</span> Brands</h3>
            <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
                <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                    @foreach ($brands as $item)
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="{{ asset('storage/' . $item->avatar) }}" alt="">
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </section>

    <!-- category section end -->



    <style>
        .products-c .bg-size {
            background-position: center 0 !important;
        }
    </style>



    <script src="{{ asset('assets/js/js2/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/js2/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/js2/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/js2/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/slick.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/wow.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/counterup.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/js2/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('assets/js/js2/main.js?v=3.3') }}"></script>
    <script src="{{ asset('assets/js/js2/shop.js?v=3.3') }}"></script>
@endsection
