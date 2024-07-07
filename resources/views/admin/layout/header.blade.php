<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('admin.home.index') }}"><img src="{{ asset('storage/' . $logo->path) }}" class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.home.index') }}"><img src="{{ asset('storage/' . $logo->path) }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <a class="navbar-toggler navbar-toggler align-self-center p-0" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
            <script>
                document.querySelector('.icon-menu').addEventListener('click', function() {
                    if (document.body.classList.contains('sidebar-icon-only')) {
                        document.body.classList.remove('sidebar-icon-only');
                    } else {
                        document.body.classList.add('sidebar-icon-only');
                    }
                });
            </script>
        </a>
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
                {{-- <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                            <i class="icon-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="navbar-search-input" placeholder=""
                        aria-label="search" aria-describedby="search">
                </div> --}}
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                    data-toggle="dropdown">
                    <i class="icon-bell mx-0"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                    aria-labelledby="notificationDropdown" style="max-height: 400px;overflow: overlay">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>

                    <div class="" id="notifications-container">
                        @foreach (auth()->user()->notifications as $notification)
                            <div class="notification">
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-success">
                                            <i class="ti-info-alt mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h5 class="preview-subject fw-bolder text-success">
                                            {{ $notification->data['message'] }}</h5>
                                        <h6>
                                            @if (is_array($notification->data['details']))
                                                @foreach ($notification->data['details'] as $key => $value)
                                                    <strong>{{ ucfirst($key) }}:</strong> {{ $value }}<br>
                                                @endforeach
                                            @else
                                                {{ $notification->data['details'] }}
                                            @endif
                                        </h6>
                                        <p class="font-weight-light small-text mb-0 text-muted">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </a>

                            </div>
                        @endforeach
                    </div>

                </div>
            </li>
            <li class="nav-item nav-profile dropdown ps-4">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-toggle="dropdown"
                    id="profileDropdown">
                    <h5 class="pt-2">{{ Auth::user()->name }}</h5>
                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : Auth::user()->defaultAvatar() }}"
                        alt="profile" />
                </a>

                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                        <i class="ti-settings text-primary"></i>
                        Settings
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
            <li class="nav-item nav-settings d-none d-lg-flex">
                <a class="nav-link" href="#">
                    <i class="icon-ellipsis"></i>
                </a>
            </li>
        </ul>
        <a class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" role="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </a>
    </div>
</nav>
