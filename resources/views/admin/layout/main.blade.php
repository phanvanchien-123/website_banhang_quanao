<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/theme/vendors/feather/feather.css') }} ">
    <link rel="stylesheet" href=" {{ asset('admin/theme/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/vendors/css/vendor.bundle.base.css') }} ">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/theme/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/vendors/ti-icons/css/themify-icons.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/theme/js/select.dataTables.min.css') }} ">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/theme/css/vertical-layout-light/style.css') }} ">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('admin/theme/images/favicon.png') }} " />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="">
    <div class="container-scroller">

        @include('admin.layout.frame')
        
        <!-- content -->
        @yield('content')

        
    </div>




    <!-- plugins:js -->
    <script src="{{ asset('admin/theme/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin/theme/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/theme/vendors/datatables.net/jquery.dataTables.js') }} "></script>
    <script src="{{ asset('admin/theme/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }} "></script>
    <script src="{{ asset('admin/theme/js/dataTables.select.min.js') }} "></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin/theme/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/theme/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/theme/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/theme/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/theme/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/theme/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/theme/js/off-canvas.js') }}"></script>
</body>

</html>
