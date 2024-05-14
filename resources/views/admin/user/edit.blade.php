@extends('admin.layout.main')
@section('content')
@php
  $action_url = route('admin.user.update',$user->id);
@endphp
    <div class="d-flex justify-content-between align-items-center">
        <h2>Cập nhật tài khoản</h2>
        <a href="{{ route('admin.user.index') }}">Trở về</a>
    </div>
    @include('admin.user.form')

@endsection