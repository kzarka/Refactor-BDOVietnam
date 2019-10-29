<!DOCTYPE html>
<html lang="en-US">
<head>
    @include('admin.partials.head')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('admin.partials.header')
    <div class="app-body">
        @include('admin.partials.sidebar')
        <main class="main">
            @include('admin.partials.breadscrumb')
            <div class="container-fluid">
                <div class="animated fadeIn">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    @include('admin.partials.footer')
    @include('admin.partials.foot')
</body>
</html>