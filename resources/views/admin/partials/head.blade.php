<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="description" content="{{ $sys_vars['description'] }}">
<meta name="author" content="{{ $sys_vars['author'] }}">
<meta name="keyword" content="{{ $sys_vars['keyword'] }}">
<meta property="og:url"          content="{{ url()->current() }}" />
<meta property="og:type"         content="article" />
<meta property="og:title"        content="{{ isset(app()->view->getSections()['title']) ? app()->view->getSections()['title'] : 'Undefined' }} {{ $sys_vars['title_subfix'] }}" />
<meta property="og:description"  content="{{ $sys_vars['description'] }}" />
<meta property="og:image"        content="{{ url('') . $sys_vars['default_image'] }}" />
<meta property="og:article:author" content="{{ $sys_vars['author'] }}">
<title>@yield('title') {{ $sys_vars['title_subfix'] }}</title>
@stack('before_styles')
<!-- Icons-->
<link rel="icon" type="image/ico" href="{{ $sys_vars['favicon'] }}" sizes="any" />
<link href="{{ asset('assets/plugins/coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
<!-- Main styles for this application-->
<link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/pace-progress/css/pace.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
@stack('after_styles')