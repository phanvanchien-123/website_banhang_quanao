<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('theme_admin/theme/vendors/feather/feather.css') }} ">
    <link rel="stylesheet" href=" {{ asset('theme_admin/theme/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_admin/theme/vendors/css/vendor.bundle.base.css') }} ">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('theme_admin/theme/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('theme_admin/theme/vendors/ti-icons/css/themify-icons.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme_admin/theme/js/select.dataTables.min.css') }} ">
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/vendors/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/slick/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/slick/main.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('/assets/css/demo4.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('theme_admin/theme/css/vertical-layout-light/style.css') }} ">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('theme_admin/theme/images/favicon.png') }} " />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- bs5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

<<<<<<< HEAD
=======

    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">

>>>>>>> mhhung
</head>

<body class="">
    <div class="container-scroller">

        @include('admin.layout.header')

        <div class="container-fluid page-body-wrapper ps-0">
            @include('admin.layout.themeSetting')


            @include('admin.layout.sidebar')

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
            <!-- main-panel ends -->
        </div>

    </div>




    <!-- plugins:js -->
    <script src="{{ asset('theme_admin/theme/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    {{-- <script src="{{ asset('theme_admin/theme/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('theme_admin/theme/vendors/datatables.net/jquery.dataTables.js') }} "></script>
    <script src="{{ asset('theme_admin/theme/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }} "></script>
    <script src="{{ asset('theme_admin/theme/js/dataTables.select.min.js') }} "></script> --}}

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('theme_admin/theme/js/off-canvas.js') }}"></script>
    <script src="{{ asset('theme_admin/theme/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('theme_admin/theme/js/template.js') }}"></script>
    <script src="{{ asset('theme_admin/theme/js/settings.js') }}"></script>
    <script src="{{ asset('theme_admin/theme/js/todolist.js') }}"></script>
    <script src="{{ asset('theme_admin/theme/js/todolist.js') }}"></script>
    <script src="{{ asset('theme_admin/theme/js/previewFileImage.js') }}"></script>


    {{-- <script src="{{ asset('theme_admin/theme/js/') }}"></script>
    <script src="{{ asset('theme_admin/theme/js/') }}"></script>


    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <script src="../../js/settings.js"></script>
    <script src="../../js/todolist.js"></script> --}}
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

</body>

</html>
