<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
<meta name="author" content="Kzarka">
<meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
<title>@yield('title')</title>
@stack('before_styles')
<!-- Icons-->
<link rel="icon" type="image/ico" href="./img/favicon.ico" sizes="any" />
<link href="{{ asset('assets/plugins/coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
<!-- Main styles for this application-->
<link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/pace-progress/css/pace.min.css') }}" rel="stylesheet">
@stack('after_styles')

<!-- Global site tag (gtag.js) - Google Analytics-->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  // Shared ID
  gtag('config', 'UA-118965717-3');
  // Bootstrap ID
  gtag('config', 'UA-118965717-5');
</script>