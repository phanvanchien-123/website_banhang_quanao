@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Home</a>
                <span></span> <a href="/shop">Shop</a>
                <span></span> 
        @if(request()->segment(2) == 'category')
            {{ ucfirst(request()->segment(3)) }}
        @endif
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                          <p> Hiển thị <strong class="text-brand">{{ count($products)}}</strong> sản phẩm</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="col-12">
                                <div class="filter-options">
                                   <form action="">
                                    <div class="select-options">
                                        <div class="page-view-filter">
                                            <div class="dropdown select-featured">
                                                <select class="form-select" name="sort_by" id="orderby" onchange="this.form.submit();">
                                                    <option {{ request('sort_by')=='latest'?'selected':''}} value="latest">Sắp Xếp Mới Nhất</option>
                                                    <option  {{ request('sort_by')=='oldest'?'selected':''}} value="oldest">Sắp Xếp cũ hơn </option>
                                                    <option  {{ request('sort_by')=='name-ascending'?'selected':''}} value="name-ascending">Name A-Z</option>
                                                    <option  {{ request('sort_by')=='name-descending'?'selected':''}} value="name-descending">Name Z-A</option>
                                                    <option  {{ request('sort_by')=='price-ascending'?'selected':''}} value="price-ascending">Giá Tăng Dần </option>
                                                    <option  {{ request('sort_by')=='price-descending'?'selected':''}} value="price-descending">Giá Giảm Dần </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="dropdown select-featured">
                                            <select class="form-select" name="show" id="pagesize"  onchange="this.form.submit();">
                                                <option {{ request('show')=='6'?'selected':''}}  value="6" >6 sản phẩm trên mỗi trang </option>
                                                <option {{ request('show')=='9'?'selected':''}}  value="9">9 sản phẩm trên mỗi trang</option>
                                                <option {{ request('show')=='12'?'selected':''}}  value="12">12 sản phẩm trên mỗi trang </option>
                                              
                                            </select>
                                        </div>
                                    </div>
                                   </form>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid-3">
                        @foreach ($products as $item)
                        <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="/shop/details/{{$item->id}}">
                                            <img class="default-img" src="{{asset('storage/'.$item->avatar)}}" alt="">
                                            <img class="hover-img" src="{{asset('storage/'.$item->avatar)}}" alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn hover-up" href="/shop/details/{{$item->id}}">
                                            <i class="fi-rs-search"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
                                    </div>
                                    @if ((($item->price - $item->discount)/$item->price * 100 )==30)
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">SALE 30 %</span>
                                    </div>
                                    @endif

                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="/shop/details/{{$item->id}}">{{$item->productCategory->name}}</a>
                                    </div>
                                    <h2><a href="/shop/details/{{$item->id}}">{{$item->name}}</a></h2>
                                   @if ($item->orderDetails->sum('qty') > 5)
                                       <h6 class="theme-color">Đang bán chạy</h6>
                                   @endif
                                    <div class="label-section">
                                        {{-- <span class="badge badge-grey-color">#1 Best seller</span>
                                        <span class="label-text">in fashion</span> --}}
                                        <ul class="rating my-2 d-inline-block">
                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:{{($item->avgRating)*2*10}}%">
                                                    </div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> ({{ number_format($item->avgRating,1) }}/5)</span>
                                            </div>
                                        </ul>
                                    </div>
                                    <div class="product-price">
                                        @if ($item->discount)
                                       <span>  {{number_format($item->discount,3)}} VND </span>
                                       <span class="old-price">{{number_format($item->price,3)}} VND</span>  
                                       <span> giảm {{ round((($item->price - $item->discount) /
                                        $item->price)*100)}}%</span>              
                                          
                                          @else
                                        <span>{{number_format($item->price,3)}} VND</span>

                                          @endif
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        @endforeach
                       
                      
                    </div>
                    <!--pagination-->
                    {{$products->withQueryString()->links('Client.pagination.default')}}
                </div>
               @include('Client.shop.filter')
            </div>
        </div>
    </section>
</main>
<script src="{{asset('assets/js/js2/vendor/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/js2/vendor/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/js/js2/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('assets/js/js2/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/slick.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/jquery.syotimer.min.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/wow.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/jquery-ui.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/magnific-popup.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/select2.min.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/waypoints.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/counterup.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/jquery.countdown.min.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/images-loaded.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/isotope.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/scrollup.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/jquery.vticker-min.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/jquery.theia.sticky.js')}}"></script>
<script src="{{asset('assets/js/js2/plugins/jquery.elevatezoom.js')}}"></script>
<!-- Template  JS -->
<script src="{{asset('assets/js/js2/main.js?v=3.3')}}"></script>
<script src="{{asset('assets/js/js2/shop.js?v=3.3')}}"></script>
@endsection
