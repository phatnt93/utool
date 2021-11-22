<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= asset('assets/img/tienich.png') ?>">
    <title>Utool</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('assets/google-font.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/pace-progress/themes/black/pace-theme-flat-top.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    @yield('style-libs')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/base.css') }}">
    @yield('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('Admin::partials.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Admin::partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                {{-- <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Blank Page</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>
                    </div>
                </div> --}}
            </section>

            <!-- Main content -->
            <section class="content">
                @if (Session::has('alert-error'))
                    <div class="alert alert-danger">{{ session('alert-error') }}</div>
                @endif
                @if (Session::has('alert-success'))
                    <div class="alert alert-success">{{ session('alert-success') }}</div>
                @endif
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('Admin::partials.footer')
    </div>
    <!-- ./wrapper -->

<script>
    window.translations = {!! $translation !!};
</script>
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pace-progress/pace.min.js') }}"></script>
@yield('script-libs')
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
{{-- https://github.com/CodeSeven/toastr --}}
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('assets/dist/js/demo.js') }}"></script> --}}
<script src="{{ asset('assets/admin/base.js') }}"></script>
@yield('scripts')
</body>
</html>
