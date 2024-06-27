
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
            <div class="card-body">
                @if (session('status'))
                    @php
                        $alertType = 'success';
                        $message = 'Email đã gửi hãy xác nhận để thay đổi mật khẩu!';

                        if (session('status') === 'email_sent') {
                            $message = 'Email đã được gửi thành công!';
                        } elseif (session('status') === 'email_failed') {
                            $alertType = 'danger';
                            $message = 'Gửi email thất bại. Vui lòng thử lại.';
                        } elseif (session('status') === 'invalid_email') {
                            $alertType = 'warning';
                            $message = 'Email không hợp lệ. Vui lòng kiểm tra lại.';
                        }
                    @endphp
                    <div class="alert alert-{{ $alertType }}" role="alert">
                        <i class="fa fa-info-circle"></i> {{ $message }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Nhập Email') }}</label>

                        <div class="col-md-">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    
                <div class="button login">
                    <button type="submit">
                        <span>Gửi</span>
                        <i class="fa fa-check"></i>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Log In Section End -->
@endsection

