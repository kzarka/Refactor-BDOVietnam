<title>@yield('title') {{ $sys_vars['title_subfix'] }}</title>
<!-- Header Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<meta name="description" content="{{ (isset($post) && isset($post->excert)) ? $post->excert : $sys_vars['description'] }}">
<meta name="author" content="{{ (isset($post)) ? $post->author->fullname : $sys_vars['author'] }}">
<meta name="keyword" content="{{ (isset($post) && $post->tags()->count()) ? join(',', $post->tags()->pluck('name')->toArray()) : $sys_vars['keyword'] }}">
<meta property="og:url"                content="{{ url()->current() }}" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="{{ app()->view->getSections()['title'] }} {{ $sys_vars['title_subfix'] }}" />
<meta property="og:description"        content="{{ (isset($post) && isset($post->excert)) ? $post->excert : $sys_vars['description'] }}" />
<meta property="og:image"              content="{{ (isset($post) && isset($post->banner_image)) ? $post->banner_image : (url('') . $sys_vars['default_image']) }}" />
@stack('before-style')
<style type="text/css">
img.wp-smiley,
img.emoji {
    display: inline !important;
    border: none !important;
    box-shadow: none !important;
    height: 1em !important;
    width: 1em !important;
    margin: 0 .07em !important;
    vertical-align: -0.1em !important;
    background: none !important;
    padding: 0 !important;
}
</style>
<link rel='stylesheet' id='fonts-css'  href='//fonts.googleapis.com/css?family=Roboto%3A400%2C500%2C700%26subset%3Dlatin%2Clatin-ext%7CRajdhani%3A500%2C600%2C700&#038;ver=1.0.0' type='text/css' media='all' />
<link rel='stylesheet' href="{{ asset('assets/powerup/swiper.min.css') }}" type="text/css" media="all" />
<link rel='stylesheet' href="{{ asset('assets/powerup/style.css') }}" type="text/css" media='all' />
<link rel='stylesheet' href="{{ asset('assets/powerup/head.css') }}" type="text/css" media="all" />
<link rel='stylesheet' href="{{ asset('assets/css/custom.css') }}" type="text/css" media="all" />
@stack('after-style')