<!DOCTYPE html>
<html lang="en-US">
<head>
    @include('partials.head')

    <title>@yield('title')</title>

    @yield('header-css')
</head>

<body class="@yield('body-class', 'home blog')">

<!-- BEGIN TOP ANCHOR -->
<div class="top-anchor"></div>
<!-- END TOP ANCHOR -->

<!-- BEGIN SHOW STYLED SCROLLBAR BACKGROUND -->
<div class="styled-scrollbar-track"></div>
<!-- END SHOW STYLED SCROLLBAR BACKGROUND -->

<div id="sitewrap" class="sitewrap">

    @include('partials.header')
    
    @yield('content')
    <!-- BEGIN SIDEBAR -->
    @include('partials.sidebar')
    <!-- END SIDEBAR -->
    </div>
    <!-- End Content Wrap -->
    @include('partials.footer')
    @yield('footer-scripts')
</body>
</html>