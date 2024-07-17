@extends('layouts.master')
@push('styles')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
<style>
    .size-button-container {
display: flex;
flex-direction: column;
align-items: center;
}
.color-image {
  margin-bottom: 20px;
}

.image-select h5 {
  margin-bottom: 10px;
}

.image-section {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}

.color-checkbox {
display: none;
}

.color-checkbox + label {
padding: 7px 7px;
border: 1px solid #ddd;
background-color: #f8f8f8;
cursor: pointer;
transition: background-color 0.3s ease;
position: relative;
}

.color-checkbox + label .color-box {
width: 20px;
height: 20px;
display: inline-block;
margin-right: 10px;
vertical-align: middle;
}

.color-checkbox:checked + label {
background-color: #eb6517;
color: #fff;
border-color: #eb6517;
}

.color-checkbox:checked + label::after {
content: '✔';
position: absolute;
top: 5px;
right: 5px;
font-size: 1em;
color: white;
}

.size-options {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.size-button {
  padding: 10px 15px;
  border: 1px solid #ddd;
  background-color: #f8f8f8;
  cursor: pointer;
  transition: background-color 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.size-button:hover {
  background-color: #e0e0e0;
}

.size-button.selected {
  background-color: #eb6517;
  color: #fff;
  border-color: #eb6517;
}
.size-button.disabled {
background-color: #f8f8f8;
color: #999;
border-color: #ddd;
cursor: not-allowed;
}

.size-text {
  font-weight: bold;
 
}

.qty-text {
  font-size: 0.9em;
  color: #eb6517;
}
.quantity-input {
margin-top: 10px;
}
</style>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Home</a>
                <span></span> <a href="/shop">Shop</a>
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
                                <div class="product-count">
                                    <ul>
                                        <li>
                                            <img src="/assets/images/gif/fire.gif"
                                                class="img-fluid blur-up lazyload" alt="image">
                                            <span class="p-counter">{{$orderCount}}</span>
                                            <span class="lang">Sản phẩm đã được bán  </span>
                                        </li>
                                        <li>
                                            <img src="/assets/images/gif/person.gif"
                                                class="img-fluid user_img blur-up lazyload" alt="image">
                                            <span class="p-counter">{{$products->view}}</span>
                                            <span class="lang">lượt xem sản phẩm</span>
                                        </li>
                                    </ul>
                                </div>
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
                                            <span class="font-small ml-5 text-muted"> ({{ number_format($products->avgRating,1) }}/5)</span>
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
                                <h5>Color :</h5>
                                <ul class="image-section" id="color-options">
                                    @foreach($colors as $color)
                                    <li>
                                        <input type="checkbox" id="color-{{ $loop->index }}" name="color" value="{{ $color }}" class="color-checkbox">
                                        <label for="color-{{ $loop->index }}">
                                            <span class="color-box" style="background-color: {{ $color }};"></span>
                                           
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    
                        <div id="selectSize" class="addeffect-section product-description border-product">
                            <h6 class="product-title size-text">Select Size
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#sizemodal">Size Chart</a>
                            </h6>
                            <div class="size-box">
                                <div id="size-options" class="size-options">
                                    <!-- Size buttons will be loaded here -->
                                </div>
                            </div>
                            <div class="">
                                <div id="sl" class=""></div>
                            </div>
                        </div>
                        <div id="stock-info">
                           
                                    <h6 class="product-title product-title-2 d-block">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#sizemodal">Còn : {{$products->qty}} sản phẩm có sẵn</a>
                                    </h6>
                                
                        </div>
                    <style>
                        .quantity{
                            width: 60px;
                          position: relative;
                          left: 30px;
                        }
                    </style>
                        <div class="input-group quantity-input">
                            <h6 class="product-title product-title-2 d-block">Quantity: </h6>
                            <input type="number" name="quantity" id="quantity" class="quantity" value="1" min="1" max="">

<script>
document.getElementById('quantity').addEventListener('keydown', function(e) {
    e.preventDefault();
});
</script>

                        </div>
                    
                        <form id="add-to-cart-form" method="POST" action="{{ route('cart.add', ['id' => $products->id]) }}" style="display: none;">
                            @csrf
                            <input type="hidden" id="selected-color" name="color" />
                            <input type="hidden" id="selected-size" name="size" />
                            <input type="hidden" id="selected-quantity" name="quantity" />
                        </form>
                    
                      
                        <br>
                                            <div class="product-buttons">
                                                <a href="javascript:void(0)" class="btn btn-solid">
                                                    <i class="fa fa-bookmark fz-16 me-2"></i>
                                                    <span>Wishlist</span>
                                                </a>
                                                <button id="add-to-cart-button"
                                                    class="btn btn-solid hover-solid btn-animation"
                                                    onclick="addToCart({{ $products->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                                </button>
                                            </div>
                    
                    
                        
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('.color-checkbox').change(function(){
                                    // Uncheck all other checkboxes
                                    $('.color-checkbox').not(this).prop('checked', false);
                    
                                    var selectedColor = $('.color-checkbox:checked').val();
                    
                                    if (!selectedColor) {
                                        $('#size-options').empty(); // Clear options if no color is selected
                                        $('#quantity-input-section').hide(); // Hide quantity input section
                                        $('#stock-info').show(); // Show stock info if no color is selected
                                        return;
                                    }
                    
                                    // Hide the stock info div
                                    $('#stock-info').hide();
                    
                                    var productId = "{{ $products->id }}";
                    
                                    $.ajax({
                                        url: '/shop/details/' + productId + '/sizes',
                                        method: 'GET',
                                        data: { color: selectedColor },
                                        success: function(response) {
                                            $('#size-options').empty(); // Clear existing options
                                            $('#selected-size').val(''); // Reset the hidden size input
                                            $('#quantity-input-section').hide(); // Hide quantity input section
                                            $.each(response, function(index, variant) {
                                                var qtyText = 'Hết hàng';
                                                var disabledClass = 'disabled';
                                                if (variant.qty > 1) {
                                                    qtyText = 'Còn ' + variant.qty + ' sản phẩm có sẵn';
                                                    disabledClass = '';
                                                } else if (variant.qty == 1) {
                                                    qtyText = 'Còn 1 sản phẩm có sẵn';
                                                    disabledClass = '';
                                                }
                                                $('#size-options').append('<div class="size-button-container">' +
                                                                          '<div class="size-button ' + disabledClass + '" data-size="' + variant.size + '" data-qty="' + variant.qty + '">' +
                                                                          '<div class="size-text">' + variant.size + '</div>' +
                                                                          '</div>' +
                                                                          '<div class="qty-text">' + qtyText + '</div>' +
                                                                          '</div>');
                                            });
                    
                                            // Attach click event to size buttons
                                            $('.size-button').not('.disabled').click(function() {
                                                $('.size-button').removeClass('selected');
                                                $(this).addClass('selected');
                                                $('#selected-size').val($(this).data('size')); // Update the hidden size input
                                                $('#quantity').val(1); // Reset quantity to 1
                                                $('#quantity').attr('max', $(this).data('qty')); // Set max quantity based on stock
                                                $('#quantity-input-section').show(); // Show quantity input section
                                            });
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Error loading sizes: ", status, error);
                                            alert("Failed to load sizes. Please try again later.");
                                        }
                                    });
                    
                                    $('#quantity').val(1); // Reset quantity to 1 when color is changed
                                    $('#quantity-input-section').hide(); // Hide quantity input section
                                });
                    
                                // Trigger change event on page load to populate sizes
                                $('.color-checkbox:checked').change();
                    
                                // Add to cart button click event
                                $('#add-to-cart-button').click(function() {
                                    var selectedColor = $('.color-checkbox:checked').val();
                                    var selectedSize = $('#selected-size').val();
                                    var selectedQuantity = $('#quantity').val();
                    
                                    if (!selectedColor && !selectedSize) {
    alert('Vui lòng chọn màu sắc, kích thước và nhập số lượng.');
    return false;
}

if (!selectedColor) {
    alert('Vui lòng chọn màu sắc.');
    return false;
}

if (!selectedSize) {
    alert('Vui lòng chọn kích thước.');
    return false;
}

if (!selectedQuantity) {
    alert('Vui lòng nhập số lượng.');
    return false;
}

                    
                                    $('#selected-color').val(selectedColor);
                                    $('#selected-quantity').val(selectedQuantity);
                                    $('#add-to-cart-form').submit();
                                });
                            });
                        </script>
                       
                                  <div class="pro-details-brand">
                                    <span> Brands: <a href="">{{$products->brand->name}}</a></span>
                                </div>
                                <div class="pro-details-brand">
                                    <span> Category: <a href="">{{$products->productCategory->name}}</a></span>
                                </div>
                                <div class="pro-details-brand">
                                    <span> TAG: <a href="">{{$products->tag}}</a></span>
                                </div>
            </div>
        </div>
        
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                        href="#Description">Thông tin sản phẩm</a>
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
                                        <p>{{!! $products->description !!}}</p>
                                        
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
                                                <h4 class="mb-30">Đánh giá của khách hàng </h4>
                                                <div class="comment-list">
                                                    @foreach ($comments as $item)
                                                    @if ($item->status ==1)
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                {{-- /assets/images/fashion/avatar/_default-user.png --}}
                                                                <img src="{{ $item->user->avatar ? asset('storage/'.$item->user->avatar) : asset('/assets/images/fashion/avatar/_default-user.png') }}" alt="User Avatar">

                                                                {{-- <img src="{{asset('storage/'.$item->user->avatar)}} ??/assets/images/fashion/avatar/_default-user.png" alt=""> --}}
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
                                            @if (session('successcoment'))
    <div class="alert alert-success">
        {{ session('successcoment') }}
    </div>
@endif

@if (session('errorcomnet'))
    <div class="alert alert-danger">
        {{ session('errorcomnet') }}
    </div>
@endif
                                            @endauth
    
                                            @guest
                                            <p>Hãy <a href="{{ route('login') }}"> Đăng Nhập </a>để có thể đánh giá sản phẩm
                                            </p>
                                            @endguest
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
                    </div>
                </div>
                @include('Client.shop.filter')
            </div>
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