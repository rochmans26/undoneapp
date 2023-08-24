<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LPPM UNLA</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admintemp') }}/plugins/fontawesome-free/css/all.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admintemp') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('admintemp') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- Icon Shortcut --}}
    <link rel="shortcut icon" href="{{ asset('img/ikon/Unla.png') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admintemp') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('admintemp') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admintemp') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    {{-- Sweet Alert --}}
    <link rel="stylesheet" href="{{ asset('admintemp') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admintemp') }}/dist/css/adminlte.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <style>
        .radio-group {
            display: inline-block;
            margin-right: 10px;
        }
    </style>

    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; LPPM Universitas Langlangbuana.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->




    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



    <script src="{{ asset('admintemp') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admintemp') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('admintemp') }}/plugins/select2/js/select2.full.min.js"></script>

    <script src="https://kit.fontawesome.com/2d4049b6fb.js" crossorigin="anonymous"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('admintemp') }}/dist/js/adminlte.min.js"></script>



    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script> --}}
    {{-- <script>
        $(document).ready(function() {
            $('#id_dosen').select2();
        });
    </script> --}}

    @livewireScripts
    @stack('scripts')
</body>

</html>
