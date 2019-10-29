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
<link rel='stylesheet' id='bonfire-stream-status-for-twitch-css-css'  href='http://bonfirethemes.com/powerup/one/wp-content/plugins/stream-status-for-twitch/stream-status-for-twitch.css?ver=1' type='text/css' media='all' />
<link rel='stylesheet' id='stream-status-for-twitch-fonts-css'  href='//fonts.googleapis.com/css?family=Roboto%3A500&#038;ver=1.0.0' type='text/css' media='all' />
<link rel='stylesheet' id='fonts-css'  href='//fonts.googleapis.com/css?family=Roboto%3A400%2C500%2C700%26subset%3Dlatin%2Clatin-ext%7CRajdhani%3A500%2C600%2C700&#038;ver=1.0.0' type='text/css' media='all' />
<link rel='stylesheet' id='swiper-css'  href='http://bonfirethemes.com/powerup/one/wp-content/themes/powerup/swiper.min.css?ver=4.7.14' type='text/css' media='all' />
<link rel='stylesheet' id='style-css'  href="{{ asset('assets/css/style.css') }}" type='text/css' media='all' />
<style id='style-inline-css' type='text/css'>
    .logo-wrapper img,
    .logo-wrapper span {
        top:30px;
        left:25px;
    }
    .logo-wrapper span {
        font-size:px;
        color:;
    }
    .logo-wrapper img { max-height:px; }


    .by-bonfire-wrapper,
    .by-bonfire-bg-line {
        width:px;
        height:px;
    }


        .header-tabs-wrapper > div > ul > li.marked::before {
            content:'MUST-READ!';
        }
    

    .sitewrap > .scroll-element .scroll-bar { background-color:; }
    .by-bonfire > .scroll-element .scroll-bar { background-color:; }


        .index-main-wrapper { margin-top:0; }
    

        @media screen and (max-width:780px) {
            .header-tabs-prefix,
            .header-tabs-wrapper { display:none; }
            .menu-button-wrapper { margin-left:5px; margin-top:3px; }
            .menu-tooltip:before { top:4px; }
            .menu-active { left:13px; }
            .main-nav-button-prefix-wrapper { background-image:none; }
        }
    

        @media screen and (max-width:1000px) {
            .header-search-wrapper { display:none; }
            .menu-search-wrapper { display:block; }
            .header-quicklink { border-right:none; top:-5px; right:0; }
            /* if on touch device, lessen dropdown menu padding to account for lack of styled scrollbar */    
            .by-bonfire-inner { padding-right:7px; }
            /* fixes footer spacing issue on iOS (when not enough content to scroll) */
            .sitewrap-inner { min-height:100%; }
        }
    

        @media screen and (max-width:400px) {
            .by-bonfire-wrapper {
                position:fixed !important;
                top:0;
                width:100%;
                height:100%;
            }
            .by-bonfire ul li a {
                font-size:15px;
                line-height:22px;
            }
            .by-bonfire ul.sub-menu li a {
                font-size:15px;
                line-height:22px;
            }
            .by-bonfire-inner {
                padding-top:50px;
            }
            .menu-active {
                left:0;
                right:0;
            }
            .menu-active .close-button { display:inline; }
            .menu-item-description {
                font-size:15px;
                line-height:18px;
            }
            .by-bonfire ul.sub-menu li a::after,
            .by-bonfire ul.sub-menu li.menu-item-has-children > a::after,
            .by-bonfire ul.sub-menu li.menu-item-has-children ul li a::after,
            .by-bonfire ul.sub-menu li.menu-item-has-children ul li:last-child a::after {
                font-size:15px;
            }
            .by-bonfire ul.sub-menu li a::after,
            .by-bonfire ul.sub-menu li.menu-item-has-children ul li:last-child a::after { right:-9px; }
        }
    

        .header-tabs-wrapper ul li.marked::before {
            content:'MUST-READ!';
        }
            
</style>
<!-- BEGIN CUSTOM COLORS (WP THEME CUSTOMIZER) -->
<style>
    /* background color */
    .sst-status-wrapper { background-color:; }
    /* status text color */
    .sst-status-text-live,
    .sst-status-text-offline { color:; }
    /* status text hover */
    .sst-main-wrapper:hover .sst-status-text-live span,
    .sst-main-wrapper:hover .sst-status-text-offline span { color:; }
    /* Twitch icon color */
    .sst-icon-twitch { color:; }
    /* Twitch icon background color */
    .sst-twitch-logo-wrapper { background-color:; }
    .sst-status-wrapper { border-color:; }

    /* absolute positioning */
            
    /* distances (if at top) */
    .sst-main-wrapper {
        top:px;
        left:px;
    }

    /* bottom placement + distances */
            .sst-main-wrapper {
        top:auto;
        bottom:25px;
    }

    /* right placement + distances */
            .sst-main-wrapper {
        left:auto;
        right:25px;
    }
    .sst-status-wrapper {
        left:auto;
        right:32px;
        border-right:none;
        border-left:2px solid #6441A4;
        
        -webkit-transform-origin:right top;
        -moz-transform-origin:right top;
        transform-origin:right top;
    }
    .sst-twitch-logo-wrapper { right:0; }
            
    /* disable animation */
            
    /* no status text underline */
            
    /* hide between resolutions */
    @media ( min-width:px) and (max-width:px) {
        .sst-main-wrapper { display:none !important; }
    }
</style>
<!-- END CUSTOM COLORS (WP THEME CUSTOMIZER) -->
    