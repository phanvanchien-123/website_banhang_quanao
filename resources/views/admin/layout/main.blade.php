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
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('theme_admin/theme/css/vertical-layout-light/style.css') }} ">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('theme_admin/theme/images/favicon.png') }} " />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script src="https://kit.fontawesome.com/3b9dff52ce.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

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
</body>

</html>
