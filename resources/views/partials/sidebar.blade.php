<div class="sidebar-wrapper">
    <!-- START ADS MIDDLE -->
    @include('partials.sidebar.middle_ads')
    <!-- END ADS MIDDLE -->

    <div class="widgets-wrapper">
        <!-- TAG WIDGET -->
        @include('partials.sidebar.tag')
        <!-- END TAG WIDGET -->
        
        <!-- RECENT COMMENT -->
        @include('partials.sidebar.recent_comment')
        <!-- END RECENT COMMENT -->

        <!-- RECENT POST -->
        @include('partials.sidebar.recent_post')
        <!-- END RECENT POST -->
        <div id="text-4" class="widget widget_text"><h4 class="widgettitle">Widgetized sidebar</h4>           
            <div class="textwidget">Here we have a classic widgetized WordPress sidebar. Insert a calendar, latest posts, shortcodes, custom widgets from third-party plugins etc. You are only limited by your needs and imagination.</div>
        </div>      
    </div>
</div>