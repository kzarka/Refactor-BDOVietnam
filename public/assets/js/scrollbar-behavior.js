// BEGIN ADD MAIN SITE SCROLLBAR
jQuery(function() {
'use strict';
    /* main site */
    jQuery('#sitewrap').scrollbar({
        "ignoreMobile": true,
    });
});
// END ADD MAIN SITE SCROLLBAR

// BEGIN #SITEWRAP's SCROLLBAR TRACK BEHAVIOR
jQuery('#sitewrap').scroll(function() {
    /* when scrollbar reaches top, make it stay there */
    var width = jQuery('#sitewrap').scrollTop();
    if(width > 137) {
        jQuery('.styled-scrollbar-track').addClass('scrollbar-top');
    } else {
        jQuery('.styled-scrollbar-track').removeClass('scrollbar-top');
    }
    /* gradually change styled scrollbar top distance */
    jQuery(".styled-scrollbar-track").css("top", 142 - jQuery('#sitewrap').scrollTop());
});
// END #SITEWRAP's SCROLLBAR TRACK BEHAVIOR