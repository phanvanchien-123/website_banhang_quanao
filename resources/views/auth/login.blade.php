@extends('layouts.master')

@section('content')
<style>
    input [type="text"]:focus,
    [type="email"]:focus,
    [type="url"]:focus,
    [type="password"]:focus,
    [type="number"]:focus,
    [type="date"]:focus,
    [type="datetime-local"]:focus,
    [type="month"]:focus,
    [type="search"]:focus,
    [type="tel"]:focus,
    [type="time"]:focus,
    [type="week"]:focus,
    [multiple]:focus,
    textarea:focus,
    select:focus {
        --tw-ring-color: transparent !important;
        border-color: transparent !important;
    }

    input [type="text"]:hover,
    [type="email"]:hover,
    [type="url"]:hover,
    [type="password"]:hover,
    [type="number"]:hover,
    [type="date"]:hover,
    [type="datetime-local"]:hover,
    [type="month"]:hover,
    [type="search"]:hover,
    [type="tel"]:hover,
    [type="time"]:hover,
    [type="week"]:hover,
    [multiple]:hover,
    textarea:hover,
    select:hover {
        --tw-ring-color: transparent !important;
        border-color: transparent !important;
    }

    input [type="text"]:active,
    [type="email"]:active,
    [type="url"]:active,
    [type="password"]:active,
    [type="number"]:active,
    [type="date"]:active,
    [type="datetime-local"]:active,
    [type="month"]:active,
    [type="search"]:active,
    [type="tel"]:active,
    [type="time"]:active,
    [type="week"]:active,
    [multiple]:active,
    textarea:active,
    select:active {
        --tw-ring-color: transparent !important;
        border-color: transparent !important;
    }
</style>
<!-- Log In Section Start -->
<div class="login-section">
    <div class="materialContainer">
        <div class="box">
            <form method="POST" action="{{route('login')}}">
               @csrf
                <div class="login-title">
                    <h2>Đăng Nhập</h2>
                </div>
                <div class="input">
                    <label for="name">Email</label>
                    <input type="email" id="name" name="email" :value="old('email')" required="" autofocus=""
                        autocomplete="name">
                        @error('email') <span class="text-danger mt-3">{{$message}}</span>@enderror
                </div>

                <div class="input">
                    <label for="pass">Password</label>
                    <input type="password" id="pass" class="block mt-1 w-full" name="password" required=""
                        autocomplete="current-password">
                        @error('password') <span class="text-danger mt-3">{{$message}}</span>@enderror
                </div>

                <a href="{{ route('password.request') }}" class="pass-forgot">
                    Quên mật khẩu?</a>

                <div class="button login">
                    <button type="submit">
                        <span>Đăng nhập</span>
                        <i class="fa fa-check"></i>
                    </button>
                </div>

                <p>
                    Không phải là thành viên? <a href="{{route('register')}}" class="theme-color">
                        Đăng ký ngay</a></p>
            </form>
        </div>
    </div>
</div>
<!-- Log In Section End -->
@endsection
