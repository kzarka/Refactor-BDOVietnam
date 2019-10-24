<!DOCTYPE html>
<html lang="en-US">
<head>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css" />

    <title>@yield('title')</title>

    @yield('header-css')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <div id="app">
        @include('admin.partials.header')
        <div class="app-body">
            @include('admin.partials.sidebar')
            <main class="main">
                <div class="container-fluid">
                    <div class="animated fadeIn">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</body>
</html>