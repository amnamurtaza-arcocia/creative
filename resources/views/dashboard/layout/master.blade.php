<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   @include('dashboard.layout.partials.style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('dashboard.layout.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
       @include('dashboard.layout.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
   @include('dashboard.layout.partials.script')
   @include('sweetalert::alert')

</body>
</html>
