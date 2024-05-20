@extends('layouts.master')
@push('styles')
<style>
    
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        -ms-appearance: none;
        appearance: none;
        outline: 0;
        box-shadow: none;
        border: 0 !important;
        background: #e87316;
        background-image: none;
       
    }

    .select {
        position: relative;
        display: flex;
        width: 11em;
        height: 3em;
        line-height: 3;
        background: #fff;
        overflow: hidden;
        border-radius: .50em;
    }

    select {
        flex: 1;
        padding: 0 .5em;
        color: #fff;
        cursor: pointer;
    }

    /* thiết kế dấu mũi tên */
    .select::after {
        content: '\25BC';
        position: absolute;
        top: 0;
        right: 0;
        padding: 0 1em;
        background: #e87316;
        cursor: pointer;
        pointer-events: none;
        -webkit-transition: .25s all ease;
        -o-transition: .25s all ease;
        transition: .25s all ease;
        color: white;
    }

    /* Transition */
    .select:hover::after {
        color: Gainsboro;
    }
    .color-picker {
    margin-bottom: 20px;
}

.color-picker input[type="radio"] {
    display: none;
}

.color-picker label {
    display: inline-block;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
    cursor: pointer;
}

.color-red {
    background-color: red;
}

.color-blue {
    background-color: blue;
}
.color-violet {
    background-color: violet;
}
.color-yellow {
    background-color: yellow;
}
.color-black {
    background-color: black;
}
.color-green {
    background-color: green;
}
.color-picker input[type="radio"]:checked + label {
    opacity: 0.3; /* Adjust the opacity value to change the faded effect */
}
.checkbox-group {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.checkbox-container {
    display: block;
    position: relative;
    padding-left: 20px;
    margin: 5px;
    cursor: pointer;
    font-size: 18px;
    user-select: none;
}

.checkbox-container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.checkbox-label {
    display: inline-block;
    width: 50px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    border: 2px solid #ccc;
    border-radius: 5px;
    background-color: #eee;
    transition: background-color 0.3s, border-color 0.3s;
}

.checkbox-container input:checked + .checkbox-label {
    background-color: #e87316;
    color: white;
    border-color: #e87316;
}

.checkbox-container .checkbox-label:hover {
    background-color: #ccc;
}

</style>
@section('content')
<section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>{{$products->name}}</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.htm">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{$products->name}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section> <!-- Shop Section start -->

<section>
    <div class="container">
        <div class="row gx-4 gy-5">
            <div class="col-lg-12 col-12">
                <div class="details-items">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="details-image-vertical black-slide rounded">


                                        @foreach ($products->productImages as $item)
                                        <div>
                                            <img src="/assets/images/fashion/product/front/{{$item->path}}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="details-image-1 ratio_asos">
                                        @foreach($products->productImages as $key => $image)
                                        <div>
                                            <img src="/assets/images/fashion/product/front/{{ $image->path }}"
                                                id="zoom_{{ $key + 1 }}"
                                                data-zoom-image="/assets/images/fashion/product/front/{{ $image->path }}"
                                                class="img-fluid w-100 image_zoom_cls-{{ $key }} blur-up lazyload"
                                                alt="">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="cloth-details-size">
                                <div class="product-count">
                                    <ul>
                                        <li>
                                            <img src="/assets/images/gif/fire.gif" class="img-fluid blur-up lazyload"
                                                alt="image">
                                            <span class="p-counter">37</span>
                                            <span class="lang">orders in last 24 hours</span>
                                        </li>
                                        <li>
                                            <img src="/assets/images/gif/person.gif"
                                                class="img-fluid user_img blur-up lazyload" alt="image">
                                            <span class="p-counter">44</span>
                                            <span class="lang">active view this</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="details-image-concept">
                                    <h2>{{$products->name}}</h2>
                                </div>
                                <div class="label-section">
                                    {{-- <span class="badge badge-grey-color">#1 Best seller</span>
                                    <span class="label-text">in fashion</span> --}}
                                    <ul class="rating my-2 d-inline-block">
                                        @for($i =1 ;$i<=5;$i++) @if($i <=$products->avgRating)
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
                                                (<span>{{count($products->productComments)}}</span>)
                                            </li>
                                    </ul>
                                </div>



                                <h3 class="price-detail">

                                    @if ($products->discount)
                                    {{number_format($products->discount,3)}} VND
                                    <del> {{number_format($products->price,3)}} VND</del>
                                    <span> giảm {{ round((($products->price - $products->discount) /
                                        $products->price)*100)}}%</span>
                                    @else
                                    {{number_format($products->price,3)}} VND
                                    @endif


                                </h3>
                              
                                <div class="color-image">
                                    <div class="image-select">

                                        {{-- <h5>Color :</h5>
                                        <form method="POST" action="/shop/details/{{$products->id}}">
                                            @csrf
                                            <div class="select">
                                                <select id="color" name="color" onchange="this.form.submit()">
                                                    <option> Chọn màu sắc : </option>
                                                    @foreach
                                                    (array_unique(array_column($products->productDetails->toArray(),'color'))
                                                    as $item)
                                                    <option value="{{$item}}" {{ $selectedColor==$item ? 'selected' : ''
                                                        }}>{{$item}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form> --}}
                                        <h5>Color :</h5>
                                        <form method="POST" action="/shop/details/{{ $products->id }}">
                                            @csrf
                                            {{-- <div class="select">
                                                <select id="color" name="color" onchange="this.form.submit()">
                                                    <option>Chọn màu sắc :</option>
                                                    @foreach(array_unique(array_column($products->productDetails->toArray(),
                                                    'color')) as $item)
                                                    <option value="{{ $item }}" {{ $selectedColor==$item ? 'selected'
                                                        : '' }}>{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            <div class="color-picker">
                                              <br>
                                                @foreach(array_unique(array_column($products->productDetails->toArray(),
                                                'color')) as $item)
                                                         <input type="radio" id="color-{{$item}}" name="color" value="{{$item}}" onchange="this.form.submit()"
                                                         {{ $selectedColor==$item ? 'checked' : ''}}>
                                                         <label for="color-{{$item}}" class="color-{{$item}}"></label>
                                                @endforeach
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- <div id="selectSize" class="addeffect-section product-description border-product">
                                    <h6 class="product-title size-text">select size
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#sizemodal">size chart</a>
                                    </h6>

                                    <h6 class="error-message">please select size</h6>

                                    <div class="size-box">
                                        @if($selectedColor)
                                        <div class="select">

                                            <label for="size">Size : </label>
                                            <select id="size" name="size">
                                                @foreach($sizes as $variant)
                                                <option value="{{ $variant->size }}">{{ $variant->size }} số lượng : ({{
                                                    $variant->qty }} )</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @endif
                                    </div>

                                    <h6 class="product-title product-title-2 d-block">Số Lượng </h6>

                                    <div class="qty-box">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-left-minus"
                                                    onclick="updateQuantity()" data-type="minus" data-field="">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="number" name="quantity" id="quantity"
                                                class="form-control input-number" value="1" max="{{$qty}}">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-right-plus"
                                                    onclick="updateQuantity()" data-type="plus" data-field="">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div> --}}
                                
                                <div id="selectSize" class="addeffect-section product-description border-product">
                                    <h6 class="product-title size-text">Select Size
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#sizemodal">Size Chart</a>
                                    </h6>
                                    <div class="color-image">
                                   <div class="image-select">
                                    <h5>Size : </h5>
                                 
                                   {{-- <div class="checkbox-group">
                                        
                                    @foreach(array_unique(array_column($products->productDetails->toArray(),
                                    'size')) as $item)
                                    <label class="checkbox-container">
                                        <input type="radio" name="size" value="{{ $item }}"  onchange="this.form.submit()">
                                        <span class="checkbox-label"> {{ $item }}</span>
                                    </label>
                                    @endforeach
        
                                </div> --}}
                                 
                                   
                                   
                                    <form method="POST" action="/shop/details/{{ $products->id }}">
                                        @csrf
                                       
                                        <input type="hidden" name="color" value="{{ $selectedColor }}">
                                       
                                        {{-- <div class="select">
                                            
                                            <select id="size" name="size" onchange="this.form.submit()">
                                                <option>Chọn kích thước :</option>
                                                @foreach($sizes as $variant)
                                                <option value="{{ $variant->size }}" {{ $selectedSize==$variant->size ?
                                                    'selected' : '' }}>
                                                    {{ $variant->size }} số lượng: ({{ $variant->qty }})
                                                </option>
                                                @endforeach
                                            </select>
                                        </div> --}}
                                        
                                        <div class="checkbox-group">
                                            @foreach($sizes as $variant)
                                            <label class="checkbox-container">
                                                <input type="radio" name="size" value="{{ $variant->size }}"  onchange="this.form.submit()" {{ $selectedSize==$variant->size ?
                                                    'checked' : '' }} >
                                                <span class="checkbox-label"> {{ $variant->size }}</span>
                                            </label>
                                            @endforeach
                
                                        </div>
                                    </form>
                                   </div>
                                    </div>
                                 

                                 
                                    <h6 class="product-title product-title-2 d-block">Số Lượng</h6>
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-left-minus" data-type="minus"
                                                    data-field="">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </span>
                                            <input type="number" name="quantity" id="quantity"
                                                class="form-control input-number" value="1" min="1" max="{{$quantity}}" > 
                                            <span class="input-group-prepend">
                                                <button type="button" class="btn quantity-right-plus" data-type="plus"
                                                    data-field="">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <h6 class="product-title product-title-2 d-block">CATEGORIES : {{ $products->productCategory->name}}</h6>
                                    <h6 class="product-title product-title-2 d-block">TAG : {{$products->tag}}</h6>
                                    <h6 class="product-title product-title-2 d-block">SKU : {{$products->sku}}</h6>
                                    @if ($products->qty == 0)
                                    <h6 class="product-title product-title-2 d-block">Hết Hàng </h6>
                                    @else
                                    <h6 class="product-title product-title-2 d-block">Còn : {{$products->qty}} Sản phẩm </h6>
                                    @endif
                                   
                                </div>

                                <div class="product-buttons">
                                    <a href="javascript:void(0)" class="btn btn-solid">
                                        <i class="fa fa-bookmark fz-16 me-2"></i>
                                        <span>Wishlist</span>
                                    </a>
                                    <a href="javascript:void(0)" id="cartEffect"
                                        class="btn btn-solid hover-solid btn-animation">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>Add To Cart</span>
                                        <form id="addtocart" method="post" action="http://localhost:8000/cart/store">
                                            <input type="hidden" name="_token"
                                                value="MkRqEzTGuoSx6LqJUm0OAKxSgNUYt26wTT7RMUZY"> <input type="hidden"
                                                name="id" value="1">
                                            <input type="hidden" name="name"
                                                value="Autem Repudiandae Accusantium Blanditiis">
                                            <input type="hidden" name="price" value="13">
                                            <input type="hidden" name="quantity" id="qty" value="1">
                                        </form>
                                    </a>



                                </div>

                               

                                <div class="mt-2 mt-md-3 border-product">
                                    <h6 class="product-title hurry-title d-block">Hurry Up! Left <span>10</span> in
                                        stock</h6>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 78%"></div>
                                    </div>
                                    <div class="font-light timer-5">
                                        <h5>Order in the next to get</h5>
                                        <ul class="timer1">
                                            <li class="counter">
                                                <h5 id="days">&#9251;</h5> Days :
                                            </li>
                                            <li class="counter">
                                                <h5 id="hours">&#9251;</h5> Hour :
                                            </li>
                                            <li class="counter">
                                                <h5 id="minutes">&#9251;</h5> Min :
                                            </li>
                                            <li class="counter">
                                                <h5 id="seconds">&#9251;</h5> Sec
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="border-product">
                                    <h6 class="product-title d-block">share it</h6>
                                    <div class="product-icon">
                                        <ul class="product-social">
                                            <li>
                                                <a href="https://www.facebook.com/">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.google.com/">
                                                    <i class="fab fa-google-plus-g"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://www.instagram.com/">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                            <li class="pe-0">
                                                <a href="https://www.google.com/">
                                                    <i class="fas fa-rss"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="cloth-review">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#desc" type="button">Description</button>

                            <button class="nav-link" id="nav-speci-tab" data-bs-toggle="tab" data-bs-target="#speci"
                                type="button">Thông số kỹ thuật</button>

        

                            <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#review"
                                type="button">Review ({{count($products->productComments)}} lượt đánh giá)</button>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="desc">
                            <div class="shipping-chart">
                                <div class="part">
                                    <h4 class="inner-title mb-2"></h4>
                                    <p class="font-light">   {{$products->description}}
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="speci">
                            <div class="pro mb-4">
                                <p class="font-light"> {{$products->content}}</p>
                                <div class="table-responsive">
                                    <table class="table table-part">
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <td>{{$products->name}}</td>
                                        </tr>
                                      
                                        <tr>
                                            <th>Giá </th>
                                            <td>{{$products->price}}</td>
                                        </tr>
                                        <tr>
                                            <th>Số Lượng</th>
                                            <td>{{$products->qty}} cái </td>
                                        </tr>
                                        <tr>
                                            <th>Kích thước</th>
                                            <td>{{$products->weight}} kg</td>
                                        </tr>
                                        <tr>
                                            <th>Size</th>
                                            <td>@foreach (array_unique(array_column($products->productDetails->toArray(),'size')) as $item) 
                                            {{$item}},
                                            @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Color</th>
                                            <td>@foreach (array_unique(array_column($products->productDetails->toArray(),'color')) as $item) 
                                                {{$item}}
                                                @endforeach
                                            </td>
                                        </tr>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade overflow-auto" id="nav-guide">
                            <div class="table-responsive">
                                <table class="table table-pane mb-0">
                                    <tbody>
                                        <tr class="bg-color">
                                            <th class="my-2">US Sizes</th>
                                            <td>6</td>
                                            <td>6.5</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>8.5</td>
                                            <td>9</td>
                                            <td>9.5</td>
                                            <td>10</td>
                                            <td>10.5</td>
                                            <td>11</td>
                                        </tr>

                                        <tr>
                                            <th>Euro Sizes</th>
                                            <td>39</td>
                                            <td>39</td>
                                            <td>40</td>
                                            <td>40-41</td>
                                            <td>41</td>
                                            <td>41-42</td>
                                            <td>42</td>
                                            <td>42-43</td>
                                            <td>43</td>
                                            <td>43-44</td>
                                        </tr>

                                        <tr class="bg-color">
                                            <th>UK Sizes</th>
                                            <td>5.5</td>
                                            <td>6</td>
                                            <td>6.5</td>
                                            <td>7</td>
                                            <td>7.5</td>
                                            <td>8</td>
                                            <td>8.5</td>
                                            <td>9</td>
                                            <td>10.5</td>
                                            <td>11</td>
                                        </tr>

                                        <tr>
                                            <th>Inches</th>
                                            <td>9.25"</td>
                                            <td>9.5"</td>
                                            <td>9.625"</td>
                                            <td>9.75"</td>
                                            <td>9.9735"</td>
                                            <td>10.125"</td>
                                            <td>10.25"</td>
                                            <td>10.5"</td>
                                            <td>10.765"</td>
                                            <td>10.85</td>
                                        </tr>

                                        <tr class="bg-color">
                                            <th>CM</th>
                                            <td>23.5</td>
                                            <td>24.1</td>
                                            <td>24.4</td>
                                            <td>25.4</td>
                                            <td>25.7</td>
                                            <td>26</td>
                                            <td>26.7</td>
                                            <td>27</td>
                                            <td>27.3</td>
                                            <td>27.5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="question">
                            <div class="question-answer">
                                <ul>
                                    <li>
                                        <div class="que">
                                            <i class="fas fa-question"></i>
                                            <div class="que-details">
                                                <h6>Is it compatible with all WordPress themes?</h6>
                                                <p class="font-light">If you want to see a demonstration version of
                                                    the premium plugin, you can see that in this page. If you want
                                                    to see a demonstration version of the premium plugin, you can
                                                    see that in this page. If you want to see a demonstration
                                                    version of the premium plugin, you can see that in this page.
                                                </p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="que">
                                            <i class="fas fa-question"></i>
                                            <div class="que-details">
                                                <h6>How can I try the full-featured plugin? </h6>
                                                <p class="font-light">Compatibility with all themes is impossible,
                                                    because they are too many, but generally if themes are developed
                                                    according to WordPress and WooCommerce guidelines, YITH plugins
                                                    are compatible with them. Compatibility with all themes is
                                                    impossible, because they are too many, but generally if themes
                                                    are developed according to WordPress and WooCommerce guidelines,
                                                    YITH plugins are compatible with them.</p>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="que">
                                            <i class="fas fa-question"></i>
                                            <div class="que-details">
                                                <h6>Is it compatible with all WordPress themes?</h6>
                                                <p class="font-light">If you want to see a demonstration version of
                                                    the premium plugin, you can see that in this page. If you want
                                                    to see a demonstration version of the premium plugin, you can
                                                    see that in this page. If you want to see a demonstration
                                                    version of the premium plugin, you can see that in this page.
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="review">
                            <div class="row g-4">
                                <div class="col-lg-4">
                                    <div class="customer-rating">
                                        <h2>Customer reviews</h2>
                                         <ul class="rating my-2 d-inline-block">
                                            @for($i =1 ;$i<=5;$i++)
                                                @if($i <= $products->avgRating)
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
                                               ( <span>{{count($products->productComments)}}</span>)
                                            </li>
                                        </ul>

                                        <div class="global-rating">
                                            <h5 class="font-light"><span>{{count($products->productComments)}}</span> Ratings</h5>
                                        </div>

                                       
                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    
                                    <div class="review-box">
                                        <form class="row g-4" action="/shop/details/{{ $products->id }}/Comment" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" id="" value="{{$products->id}}">
                                            <input type="hidden" name="user_id" id="" value="{{ \Illuminate\Support\Facades\Auth::user()->id ?? null }}">
                                            <div class="col-12 col-md-6">
                                                <div id="rating-stars">
                                                    <p class="d-inline-block me-2">Rating</p>
                                                    <ul class="rating mb-3 d-inline-block">
                                                   <li> <i class="fas fa-star" data-value="1"></i> </li>
                                                   <li> <i class="fas fa-star" data-value="2"></i></li>
                                                   <li> <i class="fas fa-star" data-value="3"></i></li>
                                                   <li><i class="fas fa-star" data-value="4"></i></li>
                                                   <li>  <i class="fas fa-star" data-value="5"></i></li>
                                                    </ul>
                                                </div>
                                                
                                                <input type="hidden" name="rating" id="rating" value="0">
                                                <script>
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
                                                </script>
                                            </div>
                                            

                                            <div class="col-12 ">
                                                <label class="mb-1" for="name">Name</label>
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="Enter your name" required="" name="name">
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label class="mb-1" for="id">Email Address</label>
                                                <input type="email" class="form-control" id="id"
                                                    placeholder="Email Address" required="" name="email">
                                            </div>

                                            <div class="col-12">
                                                <label class="mb-1" for="comments">Comments</label>
                                                <textarea class="form-control" placeholder="Leave a comment here"
                                                    id="comments" style="height: 100px" required="" name="messages"></textarea>
                                            </div>                    
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn default-light-theme default-theme default-theme-2">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="customer-review-box">
                                        <h4>Customer Reviews</h4>
                                        @foreach ($comments as $item)
                                        <div class="customer-section">
                                            <div class="customer-profile">
                                                <img src="/assets/images/fashion/avatar/_default-user.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </div>

                                            <div class="customer-details">
                                                <h5>{{$item->name}}</h5>
                                                <ul class="rating my-2 d-inline-block">
                                                    @for($i =1 ;$i<=5;$i++)
                                                        @if($i <= $item->rating)
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
                                                <p class="font-light">
                                                    {{$item->messages}}
                                                </p>

                                                <p class="date-custo font-light">{{$item->created_at}}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="pagination">
                                            {{$comments->withQueryString()->links('Client.pagination.default')}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section end -->

<!-- product section start -->
<section class="ratio_asos section-b-space overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-lg-4 mb-3">Customers Also Bought These</h2>
                <div class="product-wrapper product-style-2 slide-4 p-0 light-arrow bottom-space">
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="/assets/images/fashion/product/front/23.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="http://localhost:8000/assets/images/fashion/product/back/23.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Cupiditate Minus</span>
                                    <ul class="rating mt-0">
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="main-price">
                                    <a href="details.php" class="font-default">
                                        <h5>Qui Laboriosam Quas Beatae</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Dolorem nihil quia qui laudantium expedita aut dolor.
                                            Qui eligendi voluptatem autem ullam et. Voluptas nemo eum nihil aliquam
                                            eos aperiam. Numquam dolorum veniam non magnam illum odit deleniti.</p>
                                    </div>
                                    <h3 class="theme-color">$1</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/6.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/back/6.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Qui Ut</span>
                                    <ul class="rating mt-0">
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="main-price">
                                    <a href="details.php" class="font-default">
                                        <h5>Id Expedita Dolorem Sit</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Rerum consequatur sunt placeat qui vero quod.
                                            Voluptatem doloremque commodi quaerat autem fugiat iste. Voluptatem
                                            repudiandae suscipit aut aspernatur maiores repellat corrupti.</p>
                                    </div>
                                    <h3 class="theme-color">$19</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/12.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="http://localhost:8000/assets/images/fashion/product/back/12.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Blanditiis Error</span>
                                    <ul class="rating mt-0">
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="main-price">
                                    <a href="details.php" class="font-default">
                                        <h5>Laborum Debitis Necessitatibus Architecto</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Ullam iure distinctio quaerat nam quasi rerum
                                            nesciunt. Eius ut porro tempore error. Quo quibusdam est praesentium
                                            quam reprehenderit officia vero. Commodi perspiciatis totam rerum
                                            voluptatem.</p>
                                    </div>
                                    <h3 class="theme-color">$4</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/11.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="http://localhost:8000/assets/images/fashion/product/back/11.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Cupiditate Minus</span>
                                    <ul class="rating mt-0">
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="main-price">
                                    <a href="details.php" class="font-default">
                                        <h5>Quidem Architecto Deleniti Hic</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Sit repellat fugit recusandae voluptates et est.
                                            Similique et consequuntur alias officia eos. Quos sed temporibus magnam
                                            est quo aut. Totam at ducimus occaecati sequi sint sed enim.</p>
                                    </div>
                                    <h3 class="theme-color">$7</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/20.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="http://localhost:8000/assets/images/fashion/product/back/20.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Qui Ut</span>
                                    <ul class="rating mt-0">
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="main-price">
                                    <a href="details.php" class="font-default">
                                        <h5>Error Itaque Debitis Commodi</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Quos voluptates aut dolorum. Velit delectus eligendi
                                            quia est. Explicabo sit dolores laboriosam ullam voluptas.</p>
                                    </div>
                                    <h3 class="theme-color">$5</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/8.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/back/8.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Blanditiis Error</span>
                                    <ul class="rating mt-0">
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="main-price">
                                    <a href="details.php" class="font-default">
                                        <h5>Odit Corporis Ut Pariatur</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Corrupti et assumenda saepe natus voluptatem deserunt
                                            aliquam. Non esse nemo exercitationem. Expedita libero quos quibusdam.
                                        </p>
                                    </div>
                                    <h3 class="theme-color">$18</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/2.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/back/2.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Dolores Et</span>
                                    <ul class="rating mt-0">
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="main-price">
                                    <a href="details.php" class="font-default">
                                        <h5>Doloremque Quibusdam Maxime Natus</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Hic fugiat molestiae sed. Impedit iusto nihil odio
                                            eos. Nisi et est aperiam ut non culpa amet. Nemo aut et ipsa pariatur
                                            cumque. Totam eveniet voluptatibus nostrum.</p>
                                    </div>
                                    <h3 class="theme-color">$11</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="details.html">
                                        <img src="../assets/images/fashion/product/front/14.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="back">
                                    <a href="details.html">
                                        <img src="http://localhost:8000/assets/images/fashion/product/back/14.jpg"
                                            class="bg-img blur-up lazyload" alt="">
                                    </a>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)" class="addtocart-btn" data-bs-toggle="modal"
                                                data-bs-target="#addtocart">
                                                <i data-feather="shopping-bag"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#quick-view">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="wishlist">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-details">
                                <div class="rating-details">
                                    <span class="font-light grid-content">Qui Ut</span>
                                    <ul class="rating mt-0">
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star theme-color"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fas fa-star"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="main-price">
                                    <a href="details.php" class="font-default">
                                        <h5>Pariatur Qui Mollitia Et</h5>
                                    </a>
                                    <div class="listing-content">
                                        <span class="font-light">Regular Fit</span>
                                        <p class="font-light">Vero asperiores error sint soluta. Quia ut corrupti
                                            perferendis quo vero. Recusandae quae et possimus. Aut voluptatem sunt
                                            sit aliquid corporis aliquam.</p>
                                    </div>
                                    <h3 class="theme-color">$8</h3>
                                    <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->
@endsection