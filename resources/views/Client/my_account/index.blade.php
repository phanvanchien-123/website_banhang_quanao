@extends('layouts.master')
@section('content')
    <!-- Breadcrumb section start -->
    <section class="breadcrumb-section section-b-space">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>User Dashboard</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- user dashboard section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs custome-nav-tabs flex-column category-option" id="myTab">
                        <li class="nav-item mb-2">
                            <button class="nav-link font-light active" id="tab" data-bs-toggle="tab"
                                data-bs-target="#dash" type="button"><i class="fas fa-angle-right"></i>Dashboard</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="1-tab" data-bs-toggle="tab" data-bs-target="#order" type="button">
                                <span class="badge bg-primary me-1">{{$pendingOrdersCount}}</span><i class="fas fa-angle-right"></i> Đơn hàng chờ xác nhận
                            </button>
                        </li>
                        
                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="2-tab" data-bs-toggle="tab" data-bs-target="#wishlist" type="button">
                                <span class="badge bg-primary me-1">{{$confiemedOrderCount}}</span><i class="fas fa-angle-right"></i> Đơn hàng đã được xác nhận
                            </button>
                        </li>
                        

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="3-tab" data-bs-toggle="tab" data-bs-target="#save" type="button"> <span class="badge bg-primary me-1">{{$finishOrderCount}}</span><i class="fas fa-angle-right"></i> Đơn hàng giao thành công</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="4-tab" data-bs-toggle="tab" data-bs-target="#pay" type="button">  <span class="badge bg-primary me-1">{{$cancelOrderCount}}</span><i class="fas fa-angle-right"></i> Đơn đã hủy</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="5-tab" data-bs-toggle="tab"
                                data-bs-target="#profile" type="button"><i class="fas fa-angle-right"></i>Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link font-light" id="6-tab" data-bs-toggle="tab"
                                data-bs-target="#security" type="button"><i
                                    class="fas fa-angle-right"></i>Security</button>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-9">
                    <div class="filter-button dash-filter dashboard">
                        <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="dash">
                            <div class="dashboard-right">
                                <div class="dashboard">
                                    <div class="page-title title title1 title-effect">
                                        <h2>My Dashboard</h2>
                                    </div>
                                    <div class="welcome-msg">
                                        <h6 class="font-light">Hello, <span>MARK JECNO !</span></h6>
                                        <p class="font-light">From your My Account Dashboard you have the ability to
                                            view a snapshot of your recent account activity and update your account
                                            information. Select a link below to view or edit information.</p>
                                    </div>

                                    <div class="order-box-contain my-4">
                                        <div class="row g-4">
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="/assets/images/svg/box.png"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="/assets/images/svg/box1.png"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">Tất cả các đơn đã đặt</h5>
                                                            <h3>{{$ordersCount}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="/assets/images/svg/sent.png" class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="/assets/images/svg/sent1.png" class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">Những đơn hàng chưa được xác nhận </h5>
                                                            <h3>{{$pendingOrdersCount}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="/assets/images/svg/sent.png" class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="/assets/images/svg/sent1.png" class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">Những đơn hàng đã được xác nhận </h5>
                                                            <h3>{{$confiemedOrderCount}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="/assets/images/svg/sent.png" class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="/assets/images/svg/sent1.png" class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">Những đơn thành công</h5>
                                                            <h3>{{$finishOrderCount}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="/assets/images/svg/wishlist.png"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="/assets/images/svg/wishlist1.png"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">wishlist</h5>
                                                            <h3>63874</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-account box-info">
                                        <div class="box-head">
                                            <h3>Account Information</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="box">
                                                    <div class="box-title">
                                                        <h4>Contact Information</h4><a href="javascript:void(0)">Edit</a>
                                                    </div>
                                                    <div class="box-content">
                                                        <h6 class="font-light">MARK JECNO</h6>
                                                        <h6 class="font-light">MARk-JECNO@gmail.com</h6>
                                                        <a href="javascript:void(0)">Change Password</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="box">
                                                    <div class="box-title">
                                                        <h4>Newsletters</h4><a href="javascript:void(0)">Edit</a>
                                                    </div>
                                                    <div class="box-content">
                                                        <h6 class="font-light">You are currently not subscribed to any
                                                            newsletter.</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="box address-box">
                                                <div class="box-title">
                                                    <h4>Address Book</h4><a href="javascript:void(0)">Manage
                                                        Addresses</a>
                                                </div>
                                                <div class="box-content">
                                                    <div class="row g-4">
                                                        <div class="col-sm-6">
                                                            <h6 class="font-light">Default Billing Address</h6>
                                                            <h6 class="font-light">You have not set a default
                                                                billing address.</h6>
                                                            <a href="javascript:void(0)">Edit Address</a>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="font-light">Default Shipping Address</h6>
                                                            <h6 class="font-light">You have not set a default
                                                                shipping address.</h6>
                                                            <a href="javascript:void(0)">Edit Address</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('Client.my_account.pendingOrder')
                       @include('Client.my_account.confiemedOrder')
                       @include('Client.my_account.finishOrder')
                       @include('Client.my_account.cancelOrder')


                        <div class="tab-pane fade dashboard-profile dashboard" id="profile">
                            <div class="container">
                                <div class="row py-3">
                                    <div class="col-3">
                                        <h3>Thông tin cá nhân</h3>
                                    </div>
                                    <div class="col-9 border-end-0 rounded px-4 py-4 bg-body-tertiary shadow">
                                        <div class="text-center">
                                            <img id="clickableImage"
                                                src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : Auth::user()->defaultAvatar() }}"
                                                alt="profile" height="100px" width="100px"
                                                class="border rounded-circle" style="cursor: pointer">
                                        </div>
                                        <div class="py-4">
                                            <form action="{{ route('admin.profile.update') }}" method="post"
                                                class="pt-2" enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <input type="file" id="fileInput" class="d-none" name="avatar">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="Name"
                                                                placeholder="" name='name'
                                                                value="{{ Auth::user()->name }}">
                                                            <label for="Name">Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="number" class="form-control" id="Phone"
                                                                placeholder="" name="phone"
                                                                value="{{ Auth::user()->phone }}">
                                                            <label for="Phone">Phone</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="Company"
                                                                placeholder="" name="company_name"
                                                                value="{{ Auth::user()->company_name }}">
                                                            <label for="Company">Company</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (auth()->user()->province_id || auth()->user()->province_id || auth()->user()->province_id)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-floating mb-3">
                                                                <input class="form-control" type="text"
                                                                    value="{{ auth()->user()->getAddressAttribute() }}"
                                                                    aria-label="Disabled input example" disabled readonly>
                                                                <label for="Name">Địa chỉ</label>
                                                                {{-- <div class="accordion-item">
                                                                    <h2 class="accordion-header">
                                                                        <a class="accordion-button collapsed text-primary ms-1"
                                                                            type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#collapseTwo"
                                                                            aria-expanded="false"
                                                                            aria-controls="collapseTwo">
                                                                            thay đổi
                                                                        </a>
                                                                    </h2>
                                                                    <div id="collapseTwo"
                                                                        class="accordion-collapse collapse"
                                                                        data-bs-parent="#accordionExample">
                                                                        <div class="accordion-body">
                                                                            <div class="row mt-3">
                                                                                <div class="col-4">
                                                                                    <div class="form-floating mb-3">
                                                                                        <select class="form-select"
                                                                                            aria-label="Default select example"
                                                                                            id="province"
                                                                                            name="province_id"
                                                                                            onchange="loadDistricts()">
                                                                                            <option value="">--Chọn
                                                                                                tỉnh/thành--</option>
                                                                                            @foreach ($provinces as $province)
                                                                                                <option
                                                                                                    value="{{ $province->id }}">
                                                                                                    {{ $province->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <div class="form-floating mb-3">
                                                                                        <select class="form-select"
                                                                                            aria-label="Default select example"
                                                                                            id="district"
                                                                                            name="district_id"
                                                                                            onchange="loadWards()">
                                                                                            <option value="">--Chọn
                                                                                                quận/huyện--</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-4">
                                                                                    <div class="form-floating mb-3">
                                                                                        <select class="form-select"
                                                                                            aria-label="Default select example"
                                                                                            id="ward" name="ward_id">
                                                                                            <option value="">--Chọn
                                                                                                xã/phường--</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> --}}
                                                                <a class="" data-bs-toggle="collapse"
                                                                    href="#changeEmail" role="button"
                                                                    aria-expanded="false" aria-controls="changeEmail">
                                                                    Thay đổi
                                                                </a>
                                                                <div class="collapse" id="changeEmail">
                                                                    <div class="card card-body text-center border-0">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div class="form-floating mb-3">
                                                                                    <select class="form-select border"
                                                                                        aria-label="Default select example"
                                                                                        id="province" name="province_id"
                                                                                        onchange="loadDistricts()">
                                                                                        <option value="">--Chọn
                                                                                            tỉnh/thành--</option>
                                                                                        @foreach ($provinces as $province)
                                                                                            <option
                                                                                                value="{{ $province->id }}">
                                                                                                {{ $province->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="form-floating mb-3">
                                                                                    <select class="form-select border"
                                                                                        aria-label="Default select example"
                                                                                        id="district" name="district_id"
                                                                                        onchange="loadWards()">
                                                                                        <option value="">--Chọn
                                                                                            quận/huyện--</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="form-floating mb-3">
                                                                                    <select class="form-select border"
                                                                                        aria-label="Default select example"
                                                                                        id="ward" name="ward_id">
                                                                                        <option value="">--Chọn
                                                                                            xã/phường--</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="province"
                                                                    name="province_id" onchange="loadDistricts()">
                                                                    <option value="">--Chọn tỉnh/thành--</option>
                                                                    @foreach ($provinces as $province)
                                                                        <option value="{{ $province->id }}">
                                                                            {{ $province->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="district"
                                                                    name="district_id" onchange="loadWards()">
                                                                    <option value="">--Chọn quận/huyện--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-floating mb-3">
                                                                <select class="form-select"
                                                                    aria-label="Default select example" id="ward"
                                                                    name="ward_id">
                                                                    <option value="">--Chọn xã/phường--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-outline-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-3">
                                        <h3>Thay đổi mật khẩu</h3>
                                    </div>
                                    <div class="col-9 border-end-0 rounded px-4 py-4 bg-body-tertiary shadow">
                                        <form action="{{ route('admin.profile.changePassword') }}" class="pt-2">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="oldPassWord"
                                                    name="oldPassWord" placeholder="">
                                                <label for="oldPassWord">Mật khẩu cũ</label>
                                                @error('oldPassWord')
                                                    <small class="text-danger">{{ $errors->first('oldPassWord') }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="newPassWord"
                                                    name="newPassWord" placeholder="">
                                                <label for="newPassWord">Mật khẩu mới</label>
                                                @error('newPassWord')
                                                    <small class="text-danger">{{ $errors->first('newPassWord') }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="confirmPassWord"
                                                    name="confirmPassWord" placeholder="">
                                                <label for="confirmPassWord">Xác nhận mật khẩu</label>
                                                @error('confirmPassWord')
                                                    <small class="text-danger">{{ $errors->first('confirmPassWord') }}</small>
                                                @enderror
                                            </div>
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-outline-primary">Change</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                var districts = @json($districts);
                                var wards = @json($wards);
                            </script>
                        </div>

                        <div class="tab-pane fade dashboard-security dashboard" id="security">
                            <div class="box-head">
                                <h3>Delete Your Account</h3>
                            </div>
                            <div class="security-details">
                                <h5 class="font-light mt-3">Hi <span> Mark Enderess,</span>
                                </h5>
                                <p class="font-light mt-1">We Are Sorry To Here You Would Like To Delete Your Account.
                                </p>
                            </div>

                            <div class="security-details-1 mb-0">
                                <div class="page-title">
                                    <h4 class="fw-bold">Note</h4>
                                </div>
                                <p class="font-light">Deleting your account will permanently remove your profile,
                                    personal settings, and all other associated information. Once your account is
                                    deleted, You will be logged out and will be unable to log back in.</p>

                                <p class="font-light mb-4">If you understand and agree to the above statement, and would
                                    still like to delete your account, than click below</p>

                                <button class="btn btn-solid-default btn-sm fw-bold rounded" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">Delete Your
                                    Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- user dashboard section end -->
@endsection
