@extends('admin.layout.main')
@section('content')
@php
  $action_url = route('admin.coupon.update',$coupon->id);
@endphp
    <div class="d-flex justify-content-between align-items-center">
        <h2>Cập nhật mã giảm giá</h2>
        <a href="{{ route('admin.coupon.index') }}">Trở về</a>
    </div>
    @include('admin.coupons.form')

@endsection