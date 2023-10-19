<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ session('tenant_name') }}  | {{ config('app.name') }} </title>
    @include('_template.includes.head')
    

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('_template.includes.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('_template.includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                @include('_template.includes.alerts')
                @yield('pageheader')
            </section>

            <!-- Main content -->
            <section class="content">
                
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
            @yield('outcontent')
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            @yield('pagefooter', View::make('_template.includes.footer'))
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include('_template.includes.scripts')

    
</body>

</html>