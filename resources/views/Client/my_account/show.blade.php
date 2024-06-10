@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
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
                <h3></h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Cart Section Start -->
<section class="section-b-space">
    <div class="container">
        <div class="row g-6">
            <div class="col-lg-6">
                
                       <div id="billingAddress" class="row g-4">
                        <h3 class="mb-3 theme-color">Order ID : <b>{{$order->id}}</b></h3>
                          <h3 class="mb-3 theme-color">Status : <b>{{\App\Untilities\Constant::$order_status[$order->status]}}</b></h3>
                           <h3 class="mb-3 theme-color">Billing address</h3>
                           <div class="col-md-6">
                               <label for="name" class="form-label">First_Name</label>
                               <input type="text" class="form-control" id="name" name="first_name" value="{{$order->first_name}}"
                                   placeholder="First_Name">
                           </div>
                           <div class="col-md-6">
                               <label for="name" class="form-label">Last Name</label>
                               <input type="text" class="form-control" id="name" name="last_name"value="{{$order->last_name}}"
                                   placeholder="Last Name">
                           </div>
                           <div class="col-md-6">
                               <label for="name" class="form-label">Companay Name</label>
                               <input type="text" class="form-control" id="name" name="company_name"value="{{$order->company_name}}"
                                   placeholder="Enter Full Name">
                           </div>
                           <div class="col-md-6">
                               <label for="phone" class="form-label">Phone</label>
                               <input type="text" class="form-control" id="phone" name="phone" value="{{$order->phone}}"
                                   placeholder="Enter Phone Number">
                           </div>
                           <div class="col-md-6">
                               <label for="phone" class="form-label">Email</label>
                               <input type="text" class="form-control" id="phone" name="email" value="{{$order->phone}}"
                                   placeholder="Email">
                           </div>
                           
   
                           <div class="col-md-12">
                               <label for="address" class="form-label">Address</label>
                               <input type="text" class="form-control" id="phone" name="street_address" value="{{$order->street_address}}"
                               placeholder="Address">
                           </div>
   
                           <div class="col-md-3">
                               <label for="city" class="form-label">City</label>
                               <input type="text" class="form-control" id="city" name="town_city" placeholder="town_city" value="{{$order->town_city}}"> 
   
                           </div>
   
                           <div class="col-md-3">
                               <label for="country" class="form-label">Country</label>
                               <input type="text" class="form-control" id="city" name="town_city" placeholder="town_city"  value="{{$order->country}}">

                               <div class="invalid-feedback">
                                   Please select a valid country.
                               </div>
                           </div>
                          
                           <div class="col-md-3">
                               <label for="zip" class="form-label">Zip</label>
                               <input type="text" class="form-control" id="zip" name="postcode_zip"  value="{{$order->postcode_zip}}">
                           </div>
   
                           <div class="col-md-12 form-check ps-0 mt-3 custome-form-check"
                               style="padding-left:15px !important;">
                              
                              
                           </div>
                       </div>
   
                      
                       <div class="form-check ps-0 mt-3 custome-form-check">
                          
                       </div>
   
                       <hr class="my-lg-5 my-4">
   
                       <h3 class="mb-3">Payment</h3>
   
                       <div class="d-block my-3">
                           <div class="form-check custome-radio-box">
                               <input class="form-check-input" type="radio" name="payment_type" id="paypal" checked="" value="pay_later" 
                              {{$order->payment_type == 'pay_later' ? 'checked': ''}} >
                               <label class="form-check-label" for="paypal">Pay Later</label>
                           </div>
                           <div class="form-check custome-radio-box">
                               <input class="form-check-input" type="radio" name="payment_type" id="debit" value="online_payment"
                               {{$order->payment_type == 'online_payment' ? 'checked': ''}}>
                               <label class="form-check-label" for="debit">Online Payment</label>
                           </div>
                        
                </div>
                  
          
               
              
            </div>

            <div class="col-lg-6">
                <div class="order_review">
                    <div class="mb-20">
                        <h4>Your Orders</h4>
                    </div>
                    <div class="table-responsive order_table text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderDetails as $item)
                                <tr>
                                    <td class="image product-thumbnail"><img src="{{ asset('storage/'.$item->products->avatar) }}" alt="#"></td>
                                    <td>
                                        <h5><a href="product-details.html">{{ $item->products->name }}<br>SIZE: {{ $item->size }}<br>Color: {{ $item->color }}</a></h5>
                                        <span class="product-qty">x{{ $item->qty}}</span>
                                    </td>
                                    <td>{{number_format(($item->qty) *($item->amount),3)}} VND</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th>SubTotal</th>
                                    <td class="product-subtotal" colspan="2">{{ number_format(array_sum(array_column($order->orderDetails->toArray(),'total')),3)}}VND</td>
                                </tr>
                                <tr>
                                    <th>Mã giảm giá </th>
                                    <td colspan="2"><em>
                                    @if ($order->coupon == null)
                                        không áp mã giảm giá 
                                    @else
                                        - {{ number_format($order->coupon->discount_value,3)}} VND
                                    @endif
                                    </em></td>
                                </tr>
                                {{-- <tr>
                                    <th>Mã Giảm Giá</th>
                                    <td colspan="2">
                                        <label for="code">Nhập mã giảm giá:</label>
                                        <input type="text" id="code" name="code" class="form-control" placeholder="Nhập mã giảm giá">
                                        <button type="button" id="applyCouponButton">Áp dụng</button>
                                        <button id="removeCouponButton" type="button" style="display: none;">Hủy bỏ mã giảm giá</button>
                                        <div id="couponMessage"></div>
                                    </td>
                                </tr> --}}
                                {{-- <tr>
                                    <th>Giảm Giá</th>
                                    <td colspan="2" id="discountAmount">{{ number_format($discount ?? 0, 3) }} VND</td>
                                </tr> --}}
                                <tr>
                                    <th>Total</th>
                                    <td colspan="2" class="product-subtotal">
                                        <span id="totalAmount" class="font-xl text-brand fw-900">{{ number_format($order->total, 3) }} VND</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="your-cart-box">
                    <h3 class="mb-3 d-flex text-capitalize">Your cart
                </h3>
                    <ul class="list-group mb-3">

                        <li class="list-group-item d-flex lh-condensed justify-content-between">
                            <span class="fw-bold">Name - Color - Size x Số Lượng </span>
                            <strong>Giá </strong>
                        </li>
                        @foreach ($order->orderDetails as $item)
                        <li class="list-group-item d-flex justify-content-between lh-condensed active">
                            <div class="text-dark">
                                <h6 class="my-0">{{$item->products->name}} - {{$item->color}} - {{$item->size}} x {{$item->qty}}</h6>
                                <small></small>
                            </div>
                            <span>{{ number_format($item->total,3)}}VND</span>
                        </li>
                        @endforeach
                        
                        <li class="list-group-item d-flex lh-condensed justify-content-between">
                            <span class="fw-bold">Tổng </span>
                            <strong>{{ number_format(array_sum(array_column($order->orderDetails->toArray(),'total')),3)}}VND</strong>
                        </li>
                    </ul>

                   
                </div> --}}
            </div>
        </div>
    </div>
</section>
<!-- Cart Section End -->
@endsection