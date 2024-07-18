@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    @if (Auth::user()->province_id == null || Auth::user()->company_name == null)
        <section>
            <div class="container" style="margin-top: 150px">
                <h1>Vui lòng cập nhật tài khoản! <a href="/my_account/dashboard"> tại đây<i class="fi-rs-arrow-right"></i></a>
                </h1>
            </div>
        </section>
    @else
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
                            {{-- <form class="needs-validation" method="POST" id="checkoutForm" action="/checkout"> --}}
                            <form class="needs-validation" method="POST" id="checkoutForm" action="/checkout">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" id="applied_coupon_code" name="applied_coupon_code" value="">
                                <input type="hidden" name="amount" value="{{ $totalPrice - ($discount ?? 0) }}">
                                <div id="billingAddress" class="row g-4">
                                    <h3 class="mb-3 theme-color">Billing address</h3>
                                    <a href="/my_account/dashboard">Thay đổi thông tin nhận hàng tại đây <i class="fi-rs-arrow-right"></i></a>
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" placeholder="First Name" value="{{ Auth::user()->name ?? '' }}" readonly>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $errors->first('first_name')}}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Enter Phone Number" value="{{  Auth::user()->phone ?? '' }}" readonly>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ Auth::user()->email ?? '' }}" readonly>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Địa chỉ" value="{{ old('address', Auth::user()->getAddressFrom(auth()->id()) ?? '') }}" readonly>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}  <a href="/my_account/dashboard">Cập nhật tại đây<i class="fi-rs-arrow-right"></i></a></div>
                                        @enderror
                                    </div>
                                
                                    <div class="col-md-12">
                                        <label for="home_address" class="form-label">Số nhà, khu phố</label>
                                        <input type="text" class="form-control @error('home_address') is-invalid @enderror" id="home_address" name="home_address" placeholder="Địa chỉ nhà " value="{{ old('home_address', Auth::user()->company_name ?? '') }}" readonly>
                                        @error('home_address')
                                            <div class="invalid-feedback">{{ $message }}  <a href="/my_account/dashboard">Cập nhật tại đây</a></div>
                                        @enderror
                                    </div>
                                </div>
                                <hr class="my-lg-5 my-4">
                                <h3 class="mb-3">Payment</h3>
                                <div class="d-block my-3">
                                    <div class="form-check custom-radio-box">
                                        <input class="form-check-input" type="radio" name="payment_type" id="paypal"
                                            checked value="0">
                                        <label class="form-check-label" for="paypal">Pay Later</label>
                                    </div>
                                    <div class="form-check custom-radio-box">
                                        <input class="form-check-input" type="radio" name="payment_type"
                                            id="debit" value="1">
                                        <label class="form-check-label" for="debit">VNP Payment</label>
                                    </div>
                                    <div class="form-check custom-radio-box">
                                        <input class="form-check-input" type="radio" name="payment_type"
                                            id="qrpayment" value="1">
                                        <label class="form-check-label" for="qrpayment">QR Payment</label>
                                    </div>


                                    <div id="payLaterButton">
                                        <button type="submit" class="btn btn-solid-default mt-4">Pay Later</button>
                                    </div>
                                    <div id="onlinePaymentButton" style="display: none;">
                                        <button type="submit" name="redirect" class="btn btn-solid-default mt-4">VNP
                                            Payment</button>
                                    </div>
                                    <div id="qrPaymentButton" style="display: none;">
                                        <button type="submit" class="btn btn-solid-default mt-4">QR
                                            Payment</button>
                                    </div>
                                </div>
                                {{-- <button type="submit"> QR Payment</button> --}}

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
                                                <td class="image product-thumbnail"><img
                                                        src="{{ asset('storage/' . $item->product->avatar) }}"
                                                        alt="#">
                                                </td>
                                                <td>
                                                    <h5><a href="product-details.html">{{ $item->product->name }}<br>SIZE:
                                                            {{ $item->size }}<br>Color: {{ $item->color }}</a></h5>
                                                    <span class="product-qty">x{{ $item->quantity }}</span>
                                                </td>
                                                <td>{{ number_format($item->quantity * $item->price, 3) }} VND</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal" colspan="2">
                                                {{ number_format($totalPrice, 3) }}
                                                VND</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td colspan="2"><em>Free Shipping</em></td>
                                        </tr>
                                        <tr>
                                            <th>Mã Giảm Giá</th>
                                            <td colspan="2">
                                                <label for="code">Nhập mã giảm giá:</label>
                                                <input type="text" id="code" name="code" class="form-control"
                                                    placeholder="Nhập mã giảm giá">
                                                <button type="button" id="applyCouponButton">Áp dụng</button>
                                                <button id="removeCouponButton" type="button" style="display: none;">Hủy
                                                    bỏ
                                                    mã giảm giá</button>
                                                <div id="couponMessage"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Giảm Giá</th>
                                            <td colspan="2" id="discountAmount">{{ number_format($discount ?? 0, 3) }}
                                                VND
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td colspan="2" class="product-subtotal">
                                                <span id="totalAmount"
                                                    class="font-xl text-brand fw-900">{{ number_format($totalPrice - ($discount ?? 0), 3) }}
                                                    VND</span>
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
                                        // fetch('https://5a7b-117-1-160-240.ngrok-free.app/voucher_discount/apply-coupon', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': token
                                        },
                                        body: JSON.stringify({
                                            code: code
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            document.getElementById('discountAmount').innerText = data.discount + ' VND';
                                            document.getElementById('totalAmount').innerText = data.total + ' VND';
                                            document.getElementById('couponMessage').innerText = data.message;
                                            document.getElementById('applied_coupon_code').value = code;
                                            document.getElementById('removeCouponButton').style.display = '';
                                            document.querySelector('input[name="amount"]').value = data.total;
                                        } else {
                                            document.getElementById('couponMessage').innerText = data.message;
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                            });
                            document.getElementById('removeCouponButton').addEventListener('click', function() {
                                var token = document.querySelector('input[name="_token"]').value;
                                fetch('{{ route('remove.coupon') }}', {
                                        // fetch('https://5a7b-117-1-160-240.ngrok-free.app/voucher_discount/remove-coupon', {
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
                                            document.getElementById('applied_coupon_code').value =
                                                ''; // Remove applied coupon code from hidden field
                                            document.getElementById('code').value = ''; // Reset selected coupon in dropdown
                                            document.querySelector('input[name="amount"]').value = data.total;
                                        } else {
                                            document.getElementById('couponMessage').innerText = data.message;
                                        }
                                    })
                                    .catch(error => console.error('Error:', error));
                            });

                            const checkoutForm = document.getElementById('checkoutForm');
                            const payLaterRadio = document.getElementById('paypal');
                            const onlinePaymentRadio = document.getElementById('debit');
                            const qrPaymentRadio = document.getElementById('qrpayment');

                            payLaterRadio.addEventListener('change', function() {
                                if (this.checked) {
                                    checkoutForm.action = 'checkout/';
                                    document.getElementById('payLaterButton').style.display = 'block';
                                    document.getElementById('onlinePaymentButton').style.display = 'none';
                                    document.getElementById('qrPaymentButton').style.display = 'none';
                                }
                            });

                            onlinePaymentRadio.addEventListener('change', function() {
                                if (this.checked) {
                                    checkoutForm.action = 'checkout/vnPayCheck';
                                    document.getElementById('onlinePaymentButton').style.display = 'block';
                                    document.getElementById('payLaterButton').style.display = 'none';
                                    document.getElementById('qrPaymentButton').style.display = 'none';
                                }
                            });

                            qrPaymentRadio.addEventListener('change', function() {
                                if (this.checked) {
                                    checkoutForm.action = '{{ route('qrpayment') }}';
                                    document.getElementById('qrPaymentButton').style.display = 'block';
                                    document.getElementById('payLaterButton').style.display = 'none';
                                    document.getElementById('onlinePaymentButton').style.display = 'none';
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
    @endif
@endsection
