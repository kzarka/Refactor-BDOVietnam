<div id="adsense" style="display:none;">
	<script data-ad-client="ca-pub-4396527593671185" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</div>
<script type='text/javascript' src="{{ asset('assets/plugins//jquery/jquery-3.4.1.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/plugins/jquery/jquery-migrate.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/plugins/photo-swipe/photoswipe.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/plugins/jquery/jquery.scrollbar.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/js/scrollbar-behavior.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/plugins/photo-swipe/swiper.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/js/misc.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/plugins/jquery/jquery.scrollTo-min.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/plugins/fancybox/jquery.fancybox-1.3.4.js') }}"></script>
<script type="text/javascript">
	$(window).load(function(){
	    var ads = $("#adsense").find("iframe").clone();
	    if(ads.length > 0) {
	    	$("#adsense").remove();
	    	$("#middle-ads").html(ads.first());
	    }
	});
</script>
@stack('after_scripts')