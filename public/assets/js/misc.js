// BEGIN SHOW/HIDE MAIN DROPDOWN MENU
jQuery(function() {
    /* toggle menu when clicked on the menu button or close button */
    jQuery(".menu-button-wrapper, .close-button").on('click', function(e) {
        /* hide accordion menu */
        jQuery('.by-bonfire-wrapper, .by-bonfire-bg-line').toggleClass('menu-active');
        /* hide menu button active colors */
        jQuery('.menu-button-wrapper').toggleClass('menu-button-active');
        e.stopPropagation()
    });
    /* hide menu when clicked outside of it */
    jQuery(window).on('click touchend', function(e) {
        /* hide accordion menu */
        jQuery('.by-bonfire-wrapper, .by-bonfire-bg-line').removeClass('menu-active');
        /* hide menu button active colors */
        jQuery('.menu-button-wrapper').removeClass('menu-button-active');
    });  
    jQuery('.by-bonfire-wrapper, .menu-button-wrapper, .close-button').on('click touchend', function(e) {
        e.stopPropagation();
    });
});
// END SHOW/HIDE MAIN DROPDOWN MENU

// BEGIN HIGHLIGHT TOOLTIP HOVER
jQuery('.highlighted-posts-marker').on('hover touchstart', function(e) {
'use strict';
e.preventDefault();
	if(jQuery('.highlighted-posts-marker').hasClass('highlighted-posts-marker-active'))
	{
		/* hide tooltip */
		jQuery('.highlighted-posts-marker').removeClass('highlighted-posts-marker-active');
	} else {
		/* show tooltip menu */
		jQuery('.highlighted-posts-marker').addClass('highlighted-posts-marker-active');
	}
});
jQuery('.highlighted-posts-marker').on('touchend', function(e) {
'use strict';
e.preventDefault();
	jQuery('.highlighted-posts-marker').removeClass('highlighted-posts-marker-active');
});
// END HIGHLIGHT TOOLTIP HOVER

// BEGIN TRENDING TOOLTIP HOVER
jQuery('.trending-posts-marker').on('hover touchstart', function(e) {
'use strict';
e.preventDefault();
	if(jQuery('.trending-posts-marker').hasClass('trending-posts-marker-active'))
	{
		/* hide tooltip */
		jQuery('.trending-posts-marker').removeClass('trending-posts-marker-active');
	} else {
		/* show tooltip menu */
		jQuery('.trending-posts-marker').addClass('trending-posts-marker-active');
	}
});
jQuery('.trending-posts-marker').on('touchend', function(e) {
'use strict';
e.preventDefault();
	jQuery('.trending-posts-marker').removeClass('trending-posts-marker-active');
});
// END TRENDING TOOLTIP HOVER

// BEGIN INDEX FEATURED SWIPER
var swiper = new Swiper('.swiper-container', {
    pagination:'.swiper-pagination',
    paginationClickable:true,
    direction:'vertical',
    autoplayDisableOnInteraction:false,
    autoplay:6000,
    speed:750,
    effect:"fade",
    noSwipingClass:'swiper-container',
    fade:{crossFade:true}
});
// END INDEX FEATURED SWIPER

// BEGIN TRENDING TICKER
var swiper = new Swiper('.swiper-container-ticker', {
    pagination:'.swiper-pagination-ticker',
    paginationClickable:true,
    direction:'vertical',
    autoplayDisableOnInteraction:false,
    autoplay:6000,
    speed:750,
    effect:"fade",
    noSwipingClass:'swiper-container-ticker',
    prevButton:'.swiper-button-prev',
    nextButton:'.swiper-button-next',
    fade:{crossFade:true}
});
// END TRENDING TICKER

// BEGIN DETATCH AND REPOSITION STREAM STATUS
jQuery(window).load(function() {
    jQuery('.sst-main-wrapper').detach().insertAfter(".header-background");
});
// END DETATCH AND REPOSITION STREAM STATUS