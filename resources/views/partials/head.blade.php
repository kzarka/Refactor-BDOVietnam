<title>@yield('title') {{ $sys_vars['title_subfix'] }}</title>
<!-- Header Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<meta name="description" content="{{ (isset($post) && isset($post->excert)) ? $post->excert : $sys_vars['description'] }}">
<meta name="author" content="{{ (isset($post) && isset($post->author->fullname)) ? $post->author->fullname : $sys_vars['author'] }}">
<meta name="keyword" content="{{ (isset($post) && isset($post->tags) && $post->tags()->count()) ? join(',', $post->tags()->pluck('name')->toArray()) : $sys_vars['keyword'] }}">
<meta property="og:url"          content="{{ url()->current() }}" />
<meta property="og:type"         content="article" />
<meta property="og:title"        content="{{ isset(app()->view->getSections()['title']) ? app()->view->getSections()['title'] : 'Undefined' }} {{ $sys_vars['title_subfix'] }}" />
<meta property="og:description"  content="{{ (isset($post) && isset($post->excert)) ? $post->excert : $sys_vars['description'] }}" />
<meta property="og:image"        content="{{ (isset($post) && isset($post->banner_image)) ? $post->banner_image : (url('') . $sys_vars['default_image']) }}" />
<meta property="og:article:author" content="{{ (isset($post) && isset($post->author->fullname)) ? $post->author->fullname : $sys_vars['author'] }}">
@stack('before-style')
<link rel="stylesheet" href="{{ asset('assets/css/discord.css') }}" type="text/css" media="all" />
<link rel="stylesheet" id='fonts-css'  href='https://fonts.googleapis.com/css?family=Roboto%3A400%2C500%2C700%26subset%3Dlatin%2Clatin-ext%7CRajdhani%3A500%2C600%2C700&#038;ver=1.0.0' type='text/css' media='all' />
<link rel="stylesheet" href="{{ asset('assets/powerup/swiper.min.css') }}" type="text/css" media="all" />
<link rel="stylesheet" href="{{ asset('assets/powerup/style.css') }}" type="text/css" media='all' />
<link rel="stylesheet" href="{{ asset('assets/powerup/head.css') }}" type="text/css" media="all" />
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css" media="all" />
<link rel="stylesheet" href="{{ asset('assets/plugins/fancybox/jquery.fancybox-1.3.4.css') }}" type="text/css" media="all" />
@stack('after-style')
