@extends('admin.layout.main')
@section('content')
@php

@endphp
    <div class="d-flex justify-content-between align-items-center">
        <h2>Cập nhật Mã Giảm Giá</h2>
        <a href="{{ route('admin.coupon.index') }}">Trở về</a>
    </div>
    <form action="{{ route('admin.coupon.update',$coupon->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="code">Code:</label>
        <input type="text" id="code" name="code" value="{{ $coupon->code }}" required>
        
        <label for="discount_value">Discount Value:</label>
        <input type="number" id="discount_value" name="discount_value" value="{{ $coupon->discount_value }}" required>
        
        <label for="discount_type">Discount Type:</label>
        <select id="discount_type" name="discount_type" required>
            <option value="fixed" {{ $coupon->discount_type == 'fixed' ? 'selected' : '' }}>Fixed</option>
            <option value="percent" {{ $coupon->discount_type == 'percent' ? 'selected' : '' }}>Percent</option>
        </select>
        
        <label for="minimum_order_value">Minimum Order Value:</label>
        <input type="number" id="minimum_order_value" name="minimum_order_value" value="{{ $coupon->minimum_order_value }}">
        
        <label for="usage_limit">Usage Limit:</label>
        <input type="number" id="usage_limit" name="usage_limit" value="{{ $coupon->usage_limit }}">
        
        <label for="expires_at">Expires At:</label>
        <input type="date" id="expires_at" name="expires_at" value="{{ $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : '' }}">
        
        <button type="submit">Update</button>
    </form>


@endsection