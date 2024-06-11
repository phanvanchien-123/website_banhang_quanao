@extends('admin.layout.main')
@section('content')
@php
  $action_url = route('admin.coupon.store');
@endphp
    <div class="d-flex justify-content-between align-items-center">
        <h2>Thêm mới mã giảm giá</h2>
        <a href="{{ route('admin.coupon.index') }}">Trở về</a>
    </div>
    @include('admin.coupons.form')

@endsection