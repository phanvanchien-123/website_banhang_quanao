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
                                <th scope="col">Select</th>
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
                                        <input type="checkbox" name="selected_items[]" value="{{ $item->id }}">
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
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    <input type="number" name="quantity" required onchange="this.form.submit()" min="1" max="{{ $maxQuantities[$item->id] }}" class="form-control input-number" value="{{ $item->quantity }}">
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h2 class="td-color">{{ number_format($item->quantity * $item->price, 3) }} VND</h2>
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-solid-default btn fw-bold">Order Selected Items</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
