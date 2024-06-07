@extends('layouts.master')
@push('styles')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Fashion
                <span></span> {{$products->name}}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        <figure class="border-radius-10">
                                            <img src="{{asset('storage/'.$products->avatar)}}" alt="product image">
                                        </figure>
                                        @foreach ($products->productImages as $item)
                                        <figure class="border-radius-10">
                                            <img src="{{asset('storage/'.$item->path)}}" alt="product image">
                                        </figure>
                                        @endforeach




                                    </div>
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                        <div><img src="{{asset('storage/'.$products->avatar)}}" alt="product image"></div>
                                        @foreach ($products->productImages as $item)
                                        <div><img src="{{asset('storage/'.$item->path)}}" alt="product image"></div>
                                        @endforeach

                                    </div>
                                </div>
                                <!-- End Gallery -->

                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <h2 class="title-detail">{{$products->name}}</h2>
                                    <div class="product-detail-rating">
                                        <div class="pro-details-brand">
                                            <span> Brands: <a href="shop.html">{{$products->brand->name}}</a></span>
                              
                                        </div>
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:{{($products->avgRating)*2*10}}%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{ number_format($products->avgRating) }}/5)</span>
                                        </div>
                                        
                                    </div>
                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            @if ($products->discount)
                                            <ins><span class="text-brand"> {{number_format($products->discount,3)}}
                                                    VND</span></ins>
                                            <ins><span
                                                    class="old-price font-md ml-15">{{number_format($products->price,3)}}
                                                    VND</span></ins>
                                            <span class="save-price  font-md color3 ml-15">giảm {{
                                                round((($products->price - $products->discount) /
                                                $products->price)*100)}}%</span>
                                            @else
                                            <ins><span class="text-brand"> {{number_format($products->price,3)}}
                                                    VND</span></ins>

                                            @endif

                                        </div>
                                    </div>
                                    <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                    <div class="short-desc mb-30">
                                        <p>{{$products->content}}</p>
                                    </div>
                                    <div class="product_sort_info font-xs mb-30">
                                        <ul>
                                            <li class="mb-10"><i class="fi-rs-crown mr-5"></i>
                                                Bảo hành thương hiệu AL Jazeera 1 năm</li>
                                            <li class="mb-10"><i class="fi-rs-refresh mr-5"></i>
                                                Chính sách hoàn trả trong 30 ngày</li>
                                            <li><i class="fi-rs-credit-card mr-5"></i>
                                                Tiền mặt khi giao hàng có sẵn</li>
                                        </ul>
                                    </div>
                                    <div class="color-image">
                                        <div class="image-select">

                                            <form method="POST" action="/shop/details/{{ $products->id }}">
                                                @csrf
                                                <div class="attr-detail attr-color mb-15">
                                                    <h5>Color :</h5>
                                                    <div class="color-picker">

                                                        @foreach(array_unique(array_column($products->productDetails->toArray(),
                                                        'color')) as $item)
                                                        <input type="radio" id="color-{{$item}}" name="color"
                                                            value="{{$item}}" onchange="this.form.submit()" {{
                                                            $selectedColor==$item ? 'checked' : '' }}>
                                                        <label for="color-{{$item}}" class="color-{{$item}}"></label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div id="selectSize" class="addeffect-section product-description border-product">
                                        <h6 class="product-title size-text">Select Size
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#sizemodal">Size Chart</a>
                                        </h6>
                                        <div class="color-image">
                                            <div class="image-select">
                                                <h5>Size : </h5>



                                                <form method="POST" action="/shop/details/{{ $products->id }}">
                                                    @csrf

                                                    <input type="hidden" name="color" value="{{ $selectedColor }}">



                                                    <div class="checkbox-group">
                                                        @foreach($sizes as $variant)
                                                        <label class="checkbox-container">
                                                            <input type="radio" name="size" value="{{ $variant->size }}"
                                                                onchange="this.form.submit()" {{
                                                                $selectedSize==$variant->size ?
                                                            'checked' : '' }} >
                                                            <span class="checkbox-label"> {{ $variant->size }}</span>
                                                        </label>
                                                        @endforeach

                                                    </div>
                                                </form>
                                            </div>
                                        </div>



                                       
                                        <div class="qty-box">
                                            
                                            <div class="input-group">
                                                <h6 class="product-title product-title-2 d-block"> Số Lượng : </h6>
                                                <input type="number" name="quantity" id="quantity"
                                                    class="form-control input-number" value="1" min="1"
                                                    max="{{$quantity}}"> <br>
                                                

                                            </div>
                                            <div class="">
                                                @if ($selectedSize)
                                                @if ($products->qty == 0)
                                                <h6 class="product-title product-title-2 d-block"> Hết Hàng </h6>
                                                @else
                                                <h6 class="product-title product-title-2 d-block">Còn :
                                                    {{$quantity}} Sản phẩm </h6>
                                                @endif
                                                @endif
                                            </div>
                                            <div class="product-buttons">
                                                <a href="javascript:void(0)" class="btn btn-solid">
                                                    <i class="fa fa-bookmark fz-16 me-2"></i>
                                                    <span>Wishlist</span>
                                                </a>
                                                <button type="button" id="cartEffect"
                                                    class="btn btn-solid hover-solid btn-animation"
                                                    onclick="addToCart({{ $products->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                                </button>
                                            </div>
                                              <div class="pro-details-brand">
                                            <span> Brands: <a href="shop.html">{{$products->brand->name}}</a></span>
                                        </div>
                                        <div class="pro-details-brand">
                                            <span> Category: <a href="">{{$products->productCategory->name}}</a></span>
                                        </div>
                                        <div class="pro-details-brand">
                                            <span> TAG: <a href="shop.html">{{$products->tag}}</a></span>
                                        </div>
                                        </div>
                                       




                                    </div>
                                  
                                   
                                </div>
                              
                                <!-- Detail Info -->
                            </div>
                            
                            <form id="add-to-cart-form" method="POST"
                            action="{{ route('cart.add', ['id' => $products->id]) }}" style="display: none;">
                            @csrf
                            <input type="hidden" name="color" value="{{ $selectedColor }}" id="hiddenColor">
                            <input type="hidden" name="size" value="{{ $selectedSize }}" id="hiddenSize">
                            <input type="hidden" name="quantity" value="1" id="hiddenQuantity">
                        </form>
                            <script>
                                function addToCart(productId) {
                                                            // Lấy giá trị của các trường đã chọn
                                                            var selectedColor = document.querySelector('input[name="color"]:checked').value;
                                                            var selectedSize = document.querySelector('input[name="size"]:checked').value;
                                                            var quantity = document.getElementById('quantity').value;
                                                    
                                                            // Cập nhật các trường ẩn trong form "add-to-cart"
                                                            document.getElementById('hiddenColor').value = selectedColor;
                                                            document.getElementById('hiddenSize').value = selectedSize;
                                                            document.getElementById('hiddenQuantity').value = quantity;
                                                    
                                                            // Submit form "add-to-cart"
                                                            document.getElementById('add-to-cart-form').submit();
                                                        }
                            </script>
                        </div>
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                        href="#Description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                        href="#Additional-info">Thông số kỹ thuật</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Review ({{count($products->productComments)}} lượt đánh giá)</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p>{{$products->description}}</p>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                            <tr class="stand-up">
                                                <th>Tên sản phẩm</th>
                                                <td>{{$products->name}}</td>
                                            </tr>
                                            <tr class="folded-wo-wheels">
                                                <th>Giá </th>
                                            <td>{{$products->price}}</td>
                                            </tr>
                                            <tr class="folded-w-wheels">
                                                <th>Số Lượng</th>
                                                <td>{{$products->qty}} cái </td>
                                            </tr>
                                            <tr class="door-pass-through">
                                                <th>Kích thước</th>
                                            <td>{{$products->weight}} kg</td>
                                            </tr>
                                            <tr class="frame">
                                                <th>Frame</th>
                                                <td>
                                                    <p>Aluminum</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-wo-wheels">
                                                <th>Size</th>
                                                <td>@foreach(array_unique(array_column($products->productDetails->toArray(),'size'))
                                                    as $item)
                                                    {{$item}},
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr class="weight-capacity">
                                                <th>Color</th>
                                            <td>@foreach(array_unique(array_column($products->productDetails->toArray(),'color'))
                                                as $item)
                                                {{$item}}
                                                @endforeach
                                            </td>
                                            </tr>
                                            
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                    @foreach ($comments as $item)
                                                    @if ($item->status ==1)
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="/assets/images/fashion/avatar/_default-user.png" alt="">
                                                                <h6>{{$item->user->name}}</h6>
                                                                <p class="font-xxs"></p>
                                                            </div>
                                                            <div class="desc">
                                                               
                                                                    <ul class="rating my-2 d-inline-block">
                                                                        @for($i =1 ;$i<=5;$i++) @if($i <=$item->rating)
                                                                            <li>
                                                                                <i class="fas fa-star theme-color"></i>
                                                                            </li>
                                                                            @else
                                                                            <li>
                                                                                <i class="fas fa-star "></i>
                                                                            </li>
                                                                            @endif
                                                                            @endfor
                    
                                                                    </ul>
                                                               
                                                                <p> {{$item->messages}}
                                                                </p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="font-xs mr-30">{{$item->created_at}} </p>
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else

                                                    @endif
                                                    @endforeach
                                                    <div class="pagination">
                                                        {{$comments->withQueryString()->links('Client.pagination.default')}}
                                                    </div>
                                                    <!--single-comment -->
                                                  
                                                    <!--single-comment -->
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width:{{($products->avgRating)*2*10}}%">
                                                        </div>
                                                    </div>
                                                    <h6>{{ number_format($products->avgRating,1) }}
                                                      /5</h6>
                                                </div>
                                                @foreach ($products->starPercentage as $star => $percentage)
                                                <div class="progress">
                                                    <span>{{ $star }} star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;"
                                                        aria-valuenow=" {{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ number_format($percentage, 2) }}%
                                                    </div>
                                                </div>
                                                @endforeach
                                              
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="col-lg-8">
                                        <div class="review-box">
                                            <h2>Đánh Giá sản phẩm</h2>
                                            @auth
                                            <form class="row g-4" action="/shop/details/{{ $products->id }}/Comment"
                                                method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                                <input type="hidden" name="user_id"
                                                    value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
    
                                                <div class="col-12 col-md-6">
                                                    <div id="rating-stars">
                                                        <p class="d-inline-block me-2">Rating</p>
                                                        <ul class="rating mb-3 d-inline-block">
                                                            <li><i class="fas fa-star" data-value="1"></i></li>
                                                            <li><i class="fas fa-star" data-value="2"></i></li>
                                                            <li><i class="fas fa-star" data-value="3"></i></li>
                                                            <li><i class="fas fa-star" data-value="4"></i></li>
                                                            <li><i class="fas fa-star" data-value="5"></i></li>
                                                        </ul>
                                                    </div>
    
                                                    <input type="hidden" name="rating" id="rating" value="0">
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function () {
                                                                const stars = document.querySelectorAll('#rating-stars .fa-star');
                                                                
                                                                stars.forEach(star => {
                                                                    star.addEventListener('click', () => {
                                                                        const value = parseInt(star.getAttribute('data-value'));
                                                                        document.getElementById('rating').value = value;
                                                                        // Optional: Add styling to highlight selected stars
                                                                        stars.forEach(s => {
                                                                            if (parseInt(s.getAttribute('data-value')) <= value) {
                                                                                s.classList.add('theme-color');
                                                                            } else {
                                                                                s.classList.remove('theme-color');
                                                                            }
                                                                        });
                                                                    });
                                                                });
                                                            });
                                                    </script>
                                                </div>
                                                <div class="col-12">
                                                    <label class="mb-1" for="comments">Comments</label>
                                                    <textarea class="form-control" placeholder="Leave a comment here"
                                                        id="comments" style="height: 100px" required=""
                                                        name="messages"></textarea>
                                                </div>
    
                                                <div class="col-12">
                                                    <button type="submit"
                                                        class="btn default-light-theme default-theme default-theme-2">Submit</button>
                                                </div>
                                            </form>
                                            @endauth
    
                                            @guest
                                            <p>Hãy <a href="{{ route('login') }}"> Đăng Nhập </a>để có thể đánh giá sản phẩm
                                            </p>
                                            @endguest
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h3 class="section-title style-1 mb-30">Sản Phẩm Tương Tự</h3>
                            </div>
                            <div class="col-12">
                                <div class="row related-products">
                                    @foreach ($relatedproducts as $item)
                                    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                        <div class="product-cart-wrap small hover-up">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="product-details.html" tabindex="0">
                                                        <img class="default-img" src="{{asset('storage/'.$item->avatar)}}"
                                                            alt="">
                                                        <img class="hover-img" src="{{asset('storage/'.$item->avatar)}}"
                                                            alt="">
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick view" class="action-btn small hover-up"
                                                    href="/shop/details/{{$item->id}}" ><i
                                                            class="fi-rs-search"></i></a>
                                                    <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                                        href="wishlist.php" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                    <a aria-label="Compare" class="action-btn small hover-up"
                                                        href="compare.php" tabindex="0"><i
                                                            class="fi-rs-shuffle"></i></a>
                                                </div>
                                                @if ($item->discount !=null)
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">SALE</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="product-content-wrap">
                                                <h2><a href="product-details.html" tabindex="0">{{$item->name}}</a></h2>
                                                <ul class="rating mt-0">
                                                    @for($i =1 ;$i<=5;$i++) @if($i <=$item->avgRating)
                                                        <li>
                                                            <i class="fas fa-star theme-color"></i>
                                                        </li>
                                                        @else
                                                        <li>
                                                            <i class="fas fa-star "></i>
                                                        </li>
                                                        @endif
                                                        @endfor
            
                                                </ul>
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
                            </div>
                        </div>
                    </div>
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