<!-- BEGIN FOOTER -->
        <div class="footer-wrapper">
            <!-- BEGIN FOOTER MENU + SOCIAL -->
            <div class="footer-menu-social-wrapper">
                <!-- BEGIN SOCIAL -->
                <div class="social-bar-icons">
                    <a href="#" target="_blank">
                        <span class="icon-twitch"></span>
                    </a>
                    <a href="#" target="_blank">
                        <span class="icon-youtube"></span>
                    </a>
                    <a href="#" target="_blank">
                        <span class="icon-twitter"></span>
                    </a>
                    <a href="#" target="_blank">
                        <span class="icon-instagram"></span>
                    </a>
                </div>
                <!-- END SOCIAL -->
                
                <!-- BEGIN MENU -->
                <div class="footer-menu-wrapper">
                    <div class="menu-tabs-container">
                        <ul id="menu-tabs-1" class="menu">
                            <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-649">
                                <a href="http://bonfirethemes.com/powerup/one/">Front page</a>
                            </li>
                            <li class="marked menu-item menu-item-type-custom menu-item-object-custom menu-item-623">
                                <a href="http://bonfirethemes.com/powerup/one/2017/03/31/welcome-to-the-wordpress-theme-for-gamers/">About PowerUp</a>
                            </li>
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-622">
                                <a>Misc features</a>
                            </li>
                            <li class="highlighted menu-item menu-item-type-custom menu-item-object-custom menu-item-624">
                                <a href="http://bonfirethemes.com/powerup/one/category/highlighted/">Highlighted</a>
                            </li>
                        </ul>
                    </div>                
                </div>
                <!-- END MENU -->
            </div>
            <!-- END FOOTER MENU + SOCIAL -->
            <!-- BEGIN FOOTER WIDGETS -->
            <div class="footer-widgets-wrapper"></div>
            <!-- END FOOTER WIDGETS -->
            <div class="footer-background"></div>
        </div>
        <!-- END FOOTER -->
    </div>
    <!-- END .sitewrap-inner -->
</div>

<!-- BEGIN MAIN WRAPPER (show only if Twitch channel name entered) -->
<div class="sst-main-wrapper">
    <a class="sst-twitch" target="_blank" href="https://www.twitch.tv/summit1g" data-nickname="summit1g">
        <!-- BEGIN TWITCH LOGO -->
        <div class="sst-twitch-logo-wrapper">
            <div class="sst-icon-twitch"></div>
        </div>
        <!-- END TWITCH LOGO -->
        <!-- BEGIN STATUS -->
        <div class="sst-status-wrapper">
            <div class="sst-status-wrapper-inner">
                <!-- BEGIN IF ONLINE -->
                <div class="sst-status-text-live">
                    <div class="sst-live-marker"></div>
                    <span>LIVE NOW! CLICK TO VIEW.</span>
                </div>
                <!-- END IF ONLINE -->
                <!-- BEGIN IF OFFLINE -->
                <div class="sst-status-text-offline">
                    <span>CURRENTLY OFFLINE</span>
                </div>
                <!-- END IF OFFLINE -->
            </div>
        </div>
        <!-- END STATUS -->
    </a>
</div>
<!-- END MAIN WRAPPER (show only if Twitch channel name entered) -->
        
<script>
jQuery('.sst-twitch').each(function () {
    var nickname = jQuery(this).data('nickname');
    jQuery.getJSON("https://api.twitch.tv/kraken/streams/"+nickname+"?client_id=ls2awgx5gfg9m1q6iopdqb1b7d0y6a", function(c) {
        if (c.stream == null) {
            // show if offline (unless 'Hide when not streaming' option enabled)
            jQuery('.sst-main-wrapper').addClass('sst-main-wrapper-active');                    // animations
            jQuery('.sst-status-text-offline').addClass('sst-current-status');
            setTimeout(function() {
                jQuery('.sst-status-text-offline').addClass('sst-current-status-active');
                jQuery('.sst-status-wrapper').addClass('sst-status-wrapper-active');
            }, 25);
        } else {
            // show if online
            jQuery('.sst-main-wrapper').addClass('sst-main-wrapper-active');
            // animations
            jQuery('.sst-status-text-live').addClass('sst-current-status');
            setTimeout(function() {
                jQuery('.sst-status-text-live').addClass('sst-current-status-active');
                jQuery('.sst-status-wrapper').addClass('sst-status-wrapper-active');
            }, 25);
        }
    });
});
</script>

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript' src='http://bonfirethemes.com/powerup/one/wp-content/plugins/photo-swipe/lib/photoswipe.min.js?ver=4.1.1.1'></script>
<script type='text/javascript' src='http://bonfirethemes.com/powerup/one/wp-content/plugins/photo-swipe/lib/photoswipe-ui-default.min.js?ver=4.1.1.1'></script>
<script type='text/javascript' src="{{ asset('assets/plugins//jquery/jquery-3.4.1.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/plugins/jquery/jquery-migrate.min.js') }}"></script>
<script type='text/javascript' src='http://bonfirethemes.com/powerup/one/wp-content/plugins/photo-swipe/js/photoswipe.js?ver=4.1.1.1'></script>
<script type='text/javascript' src="{{ asset('assets/plugins/jquery/jquery.scrollbar.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/js/scrollbar-behavior.js') }}"></script>
<script type='text/javascript' src='http://bonfirethemes.com/powerup/one/wp-content/themes/powerup/js/swiper.min.js?ver=1'></script>
<script type='text/javascript' src="{{ asset('assets/js/misc.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/plugins/jquery/jquery.scrollTo-min.js') }}"></script>
<script type='text/javascript' src='http://bonfirethemes.com/powerup/one/wp-includes/js/wp-embed.min.js?ver=4.7.14'></script>