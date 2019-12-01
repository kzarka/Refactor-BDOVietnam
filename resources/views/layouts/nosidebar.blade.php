<!DOCTYPE html>
<html lang="en-US">
<head>
    @include('partials.head')
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
    <div class="content-wrapper">
        @if(Request::is('/'))
        <!-- BEGIN FEATURED BACKGROUND ELEMENT (only on the front page, hide when paged) -->
        <div class="index-background-element"></div>
        <!-- END FEATURED BACKGROUND ELEMENT (only on the front page, hide when paged) -->
        @endif
        <div class="index-main-wrapper">
            @yield('content')
            @yield('sidebar')
        </div>
    </div>
    <!-- End Content Wrap -->
    @include('partials.footer')
</div>
<!-- END .sitewrap-inner -->
@include('partials.script')
</body>
</html>