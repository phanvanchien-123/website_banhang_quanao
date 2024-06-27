@extends('layouts.master')
@section('content')

<!-- Breadcrumb Section -->
<section class="breadcrumb-section section-b-space" style="padding-top:20px; padding-bottom:20px;">
    <ul class="circles">
        @for($i = 0; $i < 10; $i++)
            <li></li>
        @endfor
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Cart</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.htm">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Cart Section -->
<section class="cart-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <form action="{{ route('cart.orderSelected') }}" method="POST">
                    @csrf
                    <table class="table cart-table">
                        <thead>
                            <tr class="table-head">
                             
                              
                                <th scope="col">
                                    <input type="checkbox" id="select-all"> Tất cả
                                </th>
                                <th scope="col">Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" class="item-checkbox" data-price="{{ $item->price }}" data-quantity="{{ $item->quantity }}">
                                    </td>
                                    <td>
                                        <a href="../product/details.html">
                                            <img src="{{ asset('storage/'.$item->product->avatar) }}" class="blur-up lazyloaded" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="../product/details.html">
                                            {{ $item->product->name }} <br> {{ $item->color }} <br> Size: {{ $item->size }}
                                        </a>
                                    </td>
                                    <td>
                                        <h2>{{ number_format($item->price, 3) }} VND</h2>
                                    </td>
                                    <td>
                                        <div class="qty-box">
                                            <div class="input-group">
                                                <input type="number" name="quantity" required onchange="updateCart('{{ $item->id }}', this.value)" min="1" max="{{ $maxQuantities[$item->id] }}" class="form-control input-number" value="{{ $item->quantity }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h2 class="td-color">{{ number_format($item->quantity * $item->price, 3) }} VND</h2>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="deleteCartItem('{{ $item->id }}')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div >
                   
                    </div>
              
            </div>
            <div class="row">
                <div class="col-sm-7 col-5 order-1">
                    <div class="left-side-button text-end d-flex d-block justify-content-end">
                        <button type="button" class="btn btn-danger" onclick="clearCart()">Clear Cart</button>
                    </div>
                </div>
                <div class="col-sm-5 col-7">
                    <div class="left-side-button float-start">
                        <a href="../shop.html" class="btn btn-solid-default btn fw-bold mb-0 ms-0">
                            <i class="fas fa-arrow-left"></i> Continue Shopping</a>
                    </div>
                </div>
            </div>
            <div class="cart-checkout-section">
                <div class="row g-4">
                    <div class="col-lg-4 col-sm-6">
                        
                    </div>

                    <div class="col-lg-4 col-sm-6 ">
                        
                    </div>

                    <div class="col-lg-4">
                        <div class="cart-box">
                            <div class="cart-box-details">
                                <div class="total-details">                             
                                    <div class="top-details">
                                        <h3>Thanh Toán</h3>
                                        <h4>Tổng Tiền : <span id="total-price">0</span> </h4>
                                    </div>
                                    <div class="bottom-details">
                                        <button type="submit" class="btn btn-solid-default btn fw-bold">Đặt Hàng</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
        </div>
        </div>
    </div>
</section>

<script>
   function updateTotalPrice() {
        let totalPrice = 0;
        document.querySelectorAll('.item-checkbox:checked').forEach(function(checkbox) {
            let price = parseFloat(checkbox.dataset.price);
            let quantity = parseInt(checkbox.dataset.quantity);
            totalPrice += price * quantity;
        });
        document.getElementById('total-price').innerText = (totalPrice * 1000).toLocaleString('vi-VN') + ' VND';
    }

    document.getElementById('select-all').addEventListener('change', function(e) {
        let checkboxes = document.querySelectorAll('.item-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = e.target.checked;
        });
        updateTotalPrice();
    });

    document.querySelectorAll('.item-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            updateTotalPrice();
        });
    });

    // Initialize total price on page load
    updateTotalPrice();
    function updateCart(itemId, quantity) {
        let form = document.createElement('form');
        form.action = `{{ url('Cart/update') }}/${itemId}`;
        form.method = 'POST';
        form.style.display = 'none';

        let csrfField = document.createElement('input');
        csrfField.type = 'hidden';
        csrfField.name = '_token';
        csrfField.value = '{{ csrf_token() }}';
        form.appendChild(csrfField);

        let quantityField = document.createElement('input');
        quantityField.type = 'hidden';
        quantityField.name = 'quantity';
        quantityField.value = quantity;
        form.appendChild(quantityField);

        document.body.appendChild(form);
        form.submit();
    }

    function deleteCartItem(itemId) {
        let form = document.createElement('form');
        form.action = `{{ url('Cart/delete') }}/${itemId}`;
        form.method = 'POST';
        form.style.display = 'none';

        let csrfField = document.createElement('input');
        csrfField.type = 'hidden';
        csrfField.name = '_token';
        csrfField.value = '{{ csrf_token() }}';
        form.appendChild(csrfField);

        let methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);

        document.body.appendChild(form);
        form.submit();
    }
    function clearCart() {
        let form = document.createElement('form');
        form.action = `{{ route('cart.clearCart') }}`;
        form.method = 'POST';
        form.style.display = 'none';

        let csrfField = document.createElement('input');
        csrfField.type = 'hidden';
        csrfField.name = '_token';
        csrfField.value = '{{ csrf_token() }}';
        form.appendChild(csrfField);

        document.body.appendChild(form);
        form.submit();
    }
</script>

@endsection
