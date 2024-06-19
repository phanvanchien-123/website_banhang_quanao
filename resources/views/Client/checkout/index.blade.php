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
                @if ($totalItems > 0)
                <form class="needs-validation" method="POST" id="checkoutForm" action="/checkout">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" id="applied_coupon_code" name="applied_coupon_code" value="">
                    <div id="billingAddress" class="row g-4">
                        <h3 class="mb-3 theme-color">Billing address</h3>
                    
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
                            @error('first_name')
                                <div class="invalid-feedback">{{ $errors->first('first_name')}}</div>
                            @enderror
                        </div>
                    
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter Phone Number" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control @error('street_address') is-invalid @enderror" id="address" name="street_address" placeholder="Address" value="{{ old('street_address') }}">
                            @error('street_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="col-md-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control @error('town_city') is-invalid @enderror" id="city" name="town_city" placeholder="City" value="{{ old('town_city') }}">
                            @error('town_city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="col-md-3">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select custom-form-select @error('country') is-invalid @enderror" id="country" name="country">
                                <option value="">Select Country</option>
                                <option value="Vietnam" {{ old('country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                <!-- Add other countries as needed -->
                            </select>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control @error('postcode_zip') is-invalid @enderror" id="zip" name="postcode_zip" placeholder="123456" value="{{ old('postcode_zip') }}">
                            @error('postcode_zip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <hr class="my-lg-5 my-4">
                    <h3 class="mb-3">Payment</h3>
                    <div class="d-block my-3">
                        <div class="form-check custom-radio-box">
                            <input class="form-check-input" type="radio" name="payment_type" id="paypal" checked value="0">
                            <label class="form-check-label" for="paypal">Pay Later</label>
                        </div>
                        <div class="form-check custom-radio-box">
                            <input class="form-check-input" type="radio" name="payment_type" id="debit" value="1">
                            <label class="form-check-label" for="debit">Online Payment</label>
                        </div>
                        <div id="payLaterButton">
                            <button type="submit" class="btn btn-solid-default mt-4">Pay Later</button>
                        </div>
                        <div id="onlinePaymentButton" style="display: none;">
                            <button type="submit" name="redirect" class="btn btn-solid-default mt-4">Online Payment</button>
                        </div>
                    </div>
                </form>
                @else
                <h1>Không có hàng</h1>
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
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td class="image product-thumbnail"><img src="{{ asset('storage/'.$item->product->avatar) }}" alt="#"></td>
                                    <td>
                                        <h5><a href="product-details.html">{{ $item->product->name }}<br>SIZE: {{ $item->size }}<br>Color: {{ $item->color }}</a></h5>
                                        <span class="product-qty">x{{ $item->quantity }}</span>
                                    </td>
                                    <td>{{ number_format(($item->quantity) * ($item->price), 3) }} VND</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th>SubTotal</th>
                                    <td class="product-subtotal" colspan="2">{{ number_format($totalPrice, 3) }} VND</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td colspan="2"><em>Free Shipping</em></td>
                                </tr>
                                <tr>
                                    <th>Mã Giảm Giá</th>
                                    <td colspan="2">
                                        <label for="code">Nhập mã giảm giá:</label>
                                        <input type="text" id="code" name="code" class="form-control" placeholder="Nhập mã giảm giá">
                                        <button type="button" id="applyCouponButton">Áp dụng</button>
                                        <button id="removeCouponButton" type="button" style="display: none;">Hủy bỏ mã giảm giá</button>
                                        <div id="couponMessage"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Giảm Giá</th>
                                    <td colspan="2" id="discountAmount">{{ number_format($discount ?? 0, 3) }} VND</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td colspan="2" class="product-subtotal">
                                        <span id="totalAmount" class="font-xl text-brand fw-900">{{ number_format($totalPrice - ($discount ?? 0), 3) }} VND</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>
                    document.getElementById('applyCouponButton').addEventListener('click', function(e) {
                        e.preventDefault();
                        var code = document.getElementById('code').value;
                        var token = document.querySelector('input[name="_token"]').value;
                        fetch('{{ route('apply.coupon') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({ code: code })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('discountAmount').innerText = data.discount + ' VND';
                                document.getElementById('totalAmount').innerText = data.total + ' VND';
                                document.getElementById('couponMessage').innerText = data.message;
                                document.getElementById('applied_coupon_code').value = code;
                                document.getElementById('removeCouponButton').style.display = '';
                            } else {
                                document.getElementById('couponMessage').innerText = data.message;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    });
                    document.getElementById('removeCouponButton').addEventListener('click', function() {
    var token = document.querySelector('input[name="_token"]').value;
    fetch('{{ route('remove.coupon') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('discountAmount').innerText = '0 VND';
            document.getElementById('totalAmount').innerText = data.total + ' VND';
            document.getElementById('couponMessage').innerText = data.message;
            document.getElementById('removeCouponButton').style.display = 'none';
            document.getElementById('applied_coupon_code').value = ''; // Remove applied coupon code from hidden field
            document.getElementById('code').value = ''; // Reset selected coupon in dropdown
        } else {
            document.getElementById('couponMessage').innerText = data.message;
        }
    })
    .catch(error => console.error('Error:', error));
});

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

                    // Ensure coupon code is included in main form submission
                    checkoutForm.addEventListener('submit', function(e) {
                        var couponCode = document.getElementById('code').value;
                        document.getElementById('applied_coupon_code').value = couponCode;
                    });
                </script>
            </div>
        </div>
    </div>
</section>
<!-- Cart Section End -->
@endsection
