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
                <h3>Checkout</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
                @if ( $totalItems > 0)
                {{-- <form class="needs-validation" method="POST" action="checkout/"> --}}
                    <form class="needs-validation" method="POST" id="checkoutForm" action="checkout/">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                       <div id="billingAddress" class="row g-4">
                           <h3 class="mb-3 theme-color">Billing address</h3>
                           <div class="col-md-6">
                               <label for="name" class="form-label">First_Name</label>
                               <input type="text" class="form-control" id="name" name="first_name"
                                   placeholder="First_Name">
                           </div>
                           <div class="col-md-6">
                               <label for="name" class="form-label">Last Name</label>
                               <input type="text" class="form-control" id="name" name="last_name"
                                   placeholder="Last Name">
                           </div>
    
                           <div class="col-md-6">
                               <label for="phone" class="form-label">Phone</label>
                               <input type="text" class="form-control" id="phone" name="phone"
                                   placeholder="Enter Phone Number">
                           </div>
                           <div class="col-md-6">
                               <label for="phone" class="form-label">Email</label>
                               <input type="text" class="form-control" id="phone" name="email"
                                   placeholder="Email">
                           </div>
                           
   
                           <div class="col-md-12">
                               <label for="address" class="form-label">Address</label>
                               <input type="text" class="form-control" id="phone" name="street_address"
                               placeholder="Address">
                           </div>
   
                           <div class="col-md-3">
                               <label for="city" class="form-label">City</label>
                               <input type="text" class="form-control" id="city" name="town_city" placeholder="town_city">
   
                           </div>
   
                           <div class="col-md-3">
                               <label for="country" class="form-label">Country</label>
                               <select class="form-select custome-form-select" id="country" name="country">
                                   <option  value="VietNam">VietNam</option>
                               </select>
                               <div class="invalid-feedback">
                                   Please select a valid country.
                               </div>
                           </div>
                          
                           <div class="col-md-3">
                               <label for="zip" class="form-label">Zip</label>
                               <input type="text" class="form-control" id="zip" name="postcode_zip" placeholder="123456">
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
                               <input class="form-check-input" type="radio" name="payment_type" id="paypal" checked="" value="pay_later">
                               <label class="form-check-label" for="paypal">Pay Later</label>
                           </div>
                           <div class="form-check custome-radio-box">
                               <input class="form-check-input" type="radio" name="payment_type" id="debit" value="online_payment">
                               <label class="form-check-label" for="debit">Online Payment</label>
                           </div>
                           
                           <div id="payLaterButton" >
                            <button type="submit"class="btn btn-solid-default mt-4">Pay Later</button>
                        </div>
                        <div id="onlinePaymentButton" style="display: none;">
                            {{-- <form action="{{route('vnPayCheck.index')}}" method="POST">
                                @csrf --}}
                            <button type="submit"  name="redirect" class="btn btn-solid-default mt-4" class="">Online Payment</button>
                        
                       
                       </div>
                       
              
                   </form>
                   
                    {{-- </form> --}}
                </div>
                  
          
                {{-- <script>
                    const payLaterButton = document.getElementById('payLaterButton');
                    const onlinePaymentButton = document.getElementById('onlinePaymentButton');
                    const payLaterRadio = document.getElementById('paypal');
                    const onlinePaymentRadio = document.getElementById('debit');
                
                    payLaterRadio.addEventListener('change', function() {
                        if (this.checked) {
                            payLaterButton.style.display = 'block';
                            onlinePaymentButton.style.display = 'none';
                        }
                    });
                
                    onlinePaymentRadio.addEventListener('change', function() {
                        if (this.checked) {
                            onlinePaymentButton.style.display = 'block';
                            payLaterButton.style.display = 'none';
                        }
                    });
                </script> --}}
                <script>
                    const checkoutForm = document.getElementById('checkoutForm');
                    const payLaterRadio = document.getElementById('paypal');
                    const onlinePaymentRadio = document.getElementById('debit');
                
                    payLaterRadio.addEventListener('change', function() {
                        if (this.checked) {
                            checkoutForm.action = 'checkout/';
                            document.getElementById('payLaterButton').style.display = 'block';
                            document.getElementById('onlinePaymentButton').style.display = 'none';
                        }
                    });
                
                    onlinePaymentRadio.addEventListener('change', function() {
                        if (this.checked) {
                            checkoutForm.action = 'checkout/vnPayCheck';
                            document.getElementById('onlinePaymentButton').style.display = 'block';
                            document.getElementById('payLaterButton').style.display = 'none';
                        }
                    });
                </script>
                    @else
                        <h1>Không có hàng </h1>
                @endif
                
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
                                @foreach ( $cartItems as $item)
                                <tr>
                                    <td class="image product-thumbnail"><img src="{{asset('storage/'.$item->product->avatar)}}" alt="#"></td>
                                    <td>
                                        <h5><a href="product-details.html">{{$item->product->name}} <br> SiZE : {{$item->size}} <br> Color : {{$item->color}}</a></h5> <span class="product-qty">x{{$item->quantity}}</span>
                                    </td>
                                    <td>
                                        {{ number_format(($item->quantity)*($item->price),3)}} VND
                                    </td>
                                </tr>
                                @endforeach
                                
                            
                                    
                                <tr>
                                    <th>SubTotal</th>
                                    <td class="product-subtotal" colspan="2">{{ number_format($totalPrice,3)}} VND</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td colspan="2"><em>Free Shipping</em></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">{{ number_format($totalPrice,3)}} VND</span></td>
                                </tr>
                            </tbody>
                        </table>
                    
                </div>
            </div>
          


        </div>
    </div>
</section>
<!-- Cart Section End -->
@endsection