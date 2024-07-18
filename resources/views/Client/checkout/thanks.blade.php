@extends('layouts.master')
@section('content')
  <h2 class="container " style="margin:50px 10px 140px 10px">Chào {{Auth::user()->name}} .<br>
    Đơn hàng đã được gửi đi, vui lòng kiểm thông tin đơn hàng trong email!
  </h2>  
@endsection