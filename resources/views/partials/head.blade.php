<title>@yield('title')</title>
<!-- Header Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
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
<link rel='stylesheet' id='photoswipe-lib-css'  href='http://bonfirethemes.com/powerup/one/wp-content/plugins/photo-swipe/lib/photoswipe.css?ver=4.1.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='photoswipe-default-skin-css'  href='http://bonfirethemes.com/powerup/one/wp-content/plugins/photo-swipe/lib/default-skin/default-skin.css?ver=4.1.1.1' type='text/css' media='all' />
<link rel='stylesheet' id='fonts-css'  href='//fonts.googleapis.com/css?family=Roboto%3A400%2C500%2C700%26subset%3Dlatin%2Clatin-ext%7CRajdhani%3A500%2C600%2C700&#038;ver=1.0.0' type='text/css' media='all' />
<link rel='stylesheet' href="{{ asset('assets/powerup/swiper.min.css') }}" type="text/css" media="all" />
<link rel='stylesheet' href="{{ asset('assets/powerup/style.css') }}" type="text/css" media='all' />
<link rel='stylesheet' href="{{ asset('assets/powerup/head.css') }}" type="text/css" media="all" />
<link rel='stylesheet' href="{{ asset('assets/admin/css/custom.css') }}" type="text/css" media="all" />
