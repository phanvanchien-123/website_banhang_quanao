<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="MkRqEzTGuoSx6LqJUm0OAKxSgNUYt26wTT7RMUZY">
    <link rel="manifest" href="manifest.json">
    <link rel="apple-touch-icon" href="{{ asset('/assets/images/favicon.ico') }}">
    <link rel="icon" href="{{ asset('/assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/assets/images/favicon.ico') }}" type="image/x-icon">
    <meta name="theme-color" content="#e87316">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Surfside Media">
    <meta name="msapplication-TileImage" content="{{ asset('/assets/images/favicon.ico') }}">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Surfside Media">
    <meta name="keywords" content="Surfside Media">
    <meta name="author" content="Surfside Media">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <title>{{ $logo->title }}</title>

    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/vendors/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/slick/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/slick/main.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('/assets/css/demo4.css') }}">

    <style>
        .h-logo {
            max-width: 185px !important;
        }

        .f-logo {
            max-width: 220px !important;
        }

        @media only screen and (max-width: 600px) {
            .h-logo {
                max-width: 110px !important;
            }
        }

        .toast-top-custom {
            top: 75px !important;
            right: 12px !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('/assets/css/custom.css') }}">


    @stack('styles')

</head>

<body class="theme-color4 light ltr">
    <style>
        header .profile-dropdown ul li {
            display: block;
            padding: 5px 20px;
            border-bottom: 1px solid #ddd;
            line-height: 35px;
        }

        header .profile-dropdown ul li:last-child {
            border-color: #fff;
        }

        header .profile-dropdown ul {
            padding: 10px 0;
            min-width: 250px;
        }

        .name-usr {
            background: #e87316;
            padding: 8px 12px;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 24px;
        }

        .name-usr span {
            margin-right: 10px;
        }

        @media (max-width:600px) {
            .h-logo {
                max-width: 150px !important;
            }

            i.sidebar-bar {
                font-size: 22px;
            }

            .mobile-menu ul li a svg {
                width: 20px;
                height: 20px;
            }

            .mobile-menu ul li a span {
                margin-top: 0px;
                font-size: 12px;
            }

            .name-usr {
                padding: 5px 12px;
            }
        }
    </style>
    <header class="header-style-2" id="home">
        <div class="main-header navbar-searchbar">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-menu">
                            <div class="menu-left">
                                <div class="brand-logo">
                                    <a href="/">
                                        <img src="{{ asset('storage/' . $logo->path) }}"
                                            class="h-logo img-fluid blur-up lazyload" alt="logo">
                                    </a>
                                </div>

                            </div>
                            <nav>
                                <div class="main-navbar">
                                    <div id="mainnav">
                                        <div class="toggle-nav">
                                            <i class="fa fa-bars sidebar-bar"></i>
                                        </div>
                                        <ul class="nav-menu">
                                            <li class="back-btn d-xl-none">
                                                <div class="close-btn">
                                                    Menu
                                                    <span class="mobile-back"><i class="fa fa-angle-left"></i>
                                                    </span>
                                                </div>
                                            </li>
                                            <li><a href="/" class="nav-link menu-title">Trang Chủ</a></li>
                                            <li><a href="{{ route('client.shop.index') }}"
                                                    class="nav-link menu-title">Cửa hàng</a></li>
                                            <li><a href="/Cart" class="nav-link menu-title">Giỏ Hàng</a></li>
                                            <li><a href="{{ route('index.coupon') }}" class="nav-link menu-title">Mã
                                                    giảm Giá</a></li>

                                            </li>
                                            <li><a href="{{ route('blog.index') }}"
                                                    class="nav-link menu-title">Blog</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <div class="menu-right">
                                <ul>
                                    <li>

                                    </li>
                                    <li class="onhover-dropdown wislist-dropdown">
                                        <div class="cart-media">
                                            <a href="wishlist/list.html">
                                                <i data-feather="heart"></i>
                                                <span id="wishlist-count" class="label label-theme rounded-pill">
                                                    0
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="onhover-dropdown wislist-dropdown">
                                        <div class="header-action-2">

                                            <div class="header-action-icon-2">
                                                <div class="cart-media">
                                                    <a href="/Cart">
                                                        <i data-feather="shopping-cart"></i>
                                                        @php
                                                            use Illuminate\Support\Facades\Auth;
                                                            use App\Models\Carts;

                                                            $totalItems = 0; // Default total items is 0

                                                            // Check if the user is logged in
                                                            if (Auth::check()) {
                                                                // Get user ID
                                                                $userId = Auth::id();
                                                                // Query the cart for the logged-in user
                                                                $cart = Carts::where('user_id', $userId)->first();
                                                                // Check if the cart exists
                                                                if ($cart) {
                                                                    // If the cart exists, calculate the total number of items
                                                                    $totalItems = $cart->cartItems->sum('quantity');
                                                                }
                                                            } else {
                                                                // Handle case when user is not logged in
                                                                // For example, you can store the cart items in session when not logged in
                                                                // and retrieve the total items count from session
                                                                $totalItems = session('cart.totalItems', 0);
                                                            }
                                                        @endphp
                                                        <span id="cart-count" class="label label-theme rounded-pill">
                                                            @if ($totalItems > 0)
                                                                {{ $totalItems }}
                                                            @else
                                                                0
                                                            @endif
                                                        </span>
                                                    </a>
                                                </div>
                                                @if ($totalItems > 0)
                                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                                        @php
                                                            $userId = Auth::id();
                                                            $cart = \App\Models\Carts::where(
                                                                'user_id',
                                                                $userId,
                                                            )->first();

                                                            // Check if the cart exists
                                                            if ($cart) {
                                                                // If the cart exists, calculate the total price and retrieve cart items
                                                                $cartItems = $cart->cartItems;
                                                                $totalPrice = $cartItems->sum(function ($item) {
                                                                    return $item->price * $item->quantity;
                                                                });
                                                            } else {
                                                                // If the cart doesn't exist, set cartItems to an empty array and totalPrice to 0
                                                                $cartItems = [];
                                                                $totalPrice = 0;
                                                            }
                                                        @endphp
                                                        <ul>
                                                            @if (!empty($cartItems))
                                                                @foreach ($cartItems as $item)
                                                                    <li>
                                                                        <div class="shopping-cart-img">
                                                                            <a
                                                                                href="/shop/details/{{ $item->product->id }}"><img
                                                                                    alt="Surfside Media"
                                                                                    src="{{ asset('storage/' . $item->product->avatar) }}"></a>
                                                                        </div>
                                                                        <div class="shopping-cart-title">
                                                                            <h4><a
                                                                                    href="/shop/details/{{ $item->product->id }}">{{ $item->name }}
                                                                                    <br>
                                                                                    {{ $item->color }}-{{ $item->size }}</a>
                                                                            </h4>
                                                                            <h4><span>{{ $item->quantity }} ×
                                                                                </span>{{ number_format($item->price, 3) }}
                                                                                VND</h4>
                                                                        </div>
                                                                        <div class="shopping-cart-delete">
                                                                            <a href="#"><i
                                                                                    class="fi-rs-cross-small"></i></a>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            @else
                                                                <li>Không có hàng nào trong giỏ hàng </li>
                                                            @endif
                                                        </ul>
                                                        <div class="shopping-cart-footer">
                                                            <div class="shopping-cart-total">
                                                                <h4>Tổng <span
                                                                        class="cart-price">{{ number_format($totalPrice, 3) }}
                                                                        VND</span></h4>
                                                            </div>
                                                            <div class="shopping-cart-button">
                                                                <a href="/Cart" class="outline">View cart</a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    </li>


                                    <li class="onhover-dropdown">
                                        <div class="cart-media name-usr">
                                            @auth
                                                <span> {{ Auth::user()->name }}</span>
                                            @endauth <i data-feather="user"></i>
                                        </div>
                                        <div class="onhover-div profile-dropdown">

                                            <ul>
                                                @if (Route::has('login'))
                                                    @auth
                                                        @if (Auth::user()->type != 'ADM')
                                                            <li>
                                                                <a href="{{ route('dashboard.index') }}"
                                                                    class="d-block">My_Account </a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a href="" class="d-block">Dashboard_Admin </a>
                                                            </li>
                                                        @endif
                                                        <li>
                                                            <a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                          document.getElementById('logout-form').submit();">Đăng
                                                                Xuất</a>
                                                            <form id="logout-form" action="{{ route('logout') }}"
                                                                method="POST">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ route('login') }}" class="d-block">Đăng Nhập </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('register') }}" class="d-block">Đăng Kí</a>
                                                        </li>
                                                    @endauth
                                                @endif


                                            </ul>
                                        </div>
                                    </li>
                                    {{-- <li>
                                        @if (session('success'))
                                            <div class="alert alert-success" id="success-alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger" id="error-alert">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                setTimeout(function() {
                                                    var successAlert = document.getElementById('success-alert');
                                                    if (successAlert) {
                                                        successAlert.style.display = 'none';
                                                    }

                                                    var errorAlert = document.getElementById('error-alert');
                                                    if (errorAlert) {
                                                        errorAlert.style.display = 'none';
                                                    }
                                                }, 5000); // 5000 milliseconds = 5 seconds
                                            });
                                        </script>

                                    </li> --}}
                                </ul>
                            </div>

                            <div class="search-full">
                                <form method="GET" class="search-full" action="shop">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <button type="submit">
                                                <i data-feather="search" class="font-light"></i></button>
                                        </span>
                                        <input type="text" name="search" class="form-control search-type"
                                            value="{{ request('search') }}" placeholder="Search here..">
                                        <span class="input-group-text close-search">
                                            <i data-feather="x" class="font-light"></i>
                                        </span>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .search {
                width: 400px;
                margin-left: 150px;
            }
        </style>
        <div class="search">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form method="GET" action="shop">
                    <input type="text" name="search" class="form-control search-type"
                        value="{{ request('search') }}" placeholder="Tìm kiếm sản phẩm..">
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
        </div>

    </header>

    <div class="mobile-menu d-sm-none">
        <ul>
            <li>
                <a href="demo3.php" class="active">
                    <i data-feather="home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i data-feather="align-justify"></i>
                    <span>Category</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i data-feather="shopping-bag"></i>
                    <span>Cart</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)">
                    <i data-feather="heart"></i>
                    <span>Wishlist</span>
                </a>
            </li>
            <li>
                <a href="user-dashboard.php">
                    <i data-feather="user"></i>
                    <span>Account</span>
                </a>
            </li>
        </ul>
    </div>
    @yield('content')

    <div id="qvmodal"></div>

    <footer class="footer-sm-space mt-5">
        <div class="main-footer">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-contact">
                            <div class="brand-logo">
                                <a href="index.htm" class="footer-logo float-start">
                                    <img src="{{ asset('assets/images/logo.png') }}"
                                        class="f-logo img-fluid blur-up lazyload" alt="logo">
                                </a>
                            </div>
                            <ul class="contact-lists" style="clear:both;">
                                <li>
                                    <span><b>phone:</b> <span class="font-light"> +1 0000000000</span></span>
                                </li>
                                <li>
                                    <span><b>Address:</b><span class="font-light"> NIT, Faridabad, Haryana,
                                            India</span></span>
                                </li>
                                <li>
                                    <span><b>Email:</b><span class="font-light"> contact@surfsidemedia.in</span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="footer-links">
                            <div class="footer-title">
                                <h3>About us</h3>
                            </div>
                            <div class="footer-content">
                                <ul>
                                    @foreach ($FLink as $item)
                                        @if ($item->title == 1)
                                            <li>
                                                <a href="{{ $item->link }}"
                                                    class="font-dark">{{ $item->subtitle }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-links">
                            <div class="footer-title">
                                <h3>New Categories</h3>
                            </div>
                            <div class="footer-content">
                                <ul>
                                    @foreach ($FLink as $item)
                                        @if ($item->title == 2)
                                            <li>
                                                <a href="{{ $item->link }}"
                                                    class="font-dark">{{ $item->subtitle }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-links">
                            <div class="footer-title">
                                <h3>Get Help</h3>
                            </div>
                            <div class="footer-content">
                                <ul>
                                    @foreach ($FLink as $item)
                                        @if ($item->title == 3)
                                            <li>
                                                <a href="{{ $item->link }}"
                                                    class="font-dark">{{ $item->subtitle }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6 d-none d-sm-block">
                        <div class="footer-newsletter">
                            <h3>Let’s stay in touch</h3>
                            <div class="form-newsletter">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control color-4"
                                        placeholder="Your Email Address">
                                    <span class="input-group-text" id="basic-addon4"><i
                                            class="fas fa-arrow-right"></i></span>
                                </div>
                                <p class="font-dark mb-0">Keep up to date with our latest news and special offers.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="sub-footer">
            <div class="container">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <ul>
                            <li class="font-dark">We accept:</li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="assets/images/payment-icon/1.jpg" class="img-fluid blur-up lazyload"
                                        alt="payment icon">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="assets/images/payment-icon/2.jpg" class="img-fluid blur-up lazyload"
                                        alt="payment icon">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="assets/images/payment-icon/3.jpg" class="img-fluid blur-up lazyload"
                                        alt="payment icon">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="assets/images/payment-icon/4.jpg" class="img-fluid blur-up lazyload"
                                        alt="payment icon">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-0 font-dark">© 2023, Surfside Media.</p>
                    </div>
                </div>
            </div>
        </div> --}}
    </footer>
    <style>
        .chatbot {
            position: relative;
            right: 20px;
        }
    </style>
    {{-- <div class="chatbot">
        <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="Shop_thoi_trang_quanao"
  agent-id="1049c744-88dd-4e38-a58d-44441f78f907"
  language-code="vi"
></df-messenger>
    </div> --}}
    {{-- <div class="zalo-chat-widget" data-oaid="2824334511651503846" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height=""></div>

<script src="https://sp.zalo.me/plugins/sdk.js"></script> --}}
    <!--Start of Fchat.vn-->
    <script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=6680fae7254c0d605e503e84"
        async="async"></script><!--End of Fchat.vn-->
    <div class="tap-to-top">
        <a href="#home">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>
    <div class="bg-overlay"></div>
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('assets/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick/custom_slick.js') }}"></script>
    <script src="{{ asset('assets/js/price-filter.js') }}"></script>
    <script src="{{ asset('assets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/filter.js') }}"></script>
    <script src="{{ asset('assets/js/newsletter.js') }}"></script>
    <script src="{{ asset('assets/js/cart_modal_resize.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme-setting.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('theme_admin/theme/js/profile.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('theme_admin/theme/js/confirmAlert.js') }}"></script>
    <script>
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
    </script>
    @stack('script')


    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-custom",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    {{-- <script>
        toastr.success('abc')
    </script> --}}

    {{-- @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}')
        </script>
    @endif
    @if (session('error'))
        <script>
            toastr.error('{{ session('error') }}')
        </script>
    @endif --}}

    {{-- <script>toastr.info('Are you the 6 fingered man?')</script> --}}

</body>
@if (session('success'))
    <script>
        toastr.success('{{ session('success') }}')
    </script>
@endif
@if (session('error'))
    <script>
        toastr.error('{{ session('error') }}')
    </script>
@endif

</html>
