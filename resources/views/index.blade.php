@extends('layouts.main')

@section('title', 'Home Page')

@section('content')
<!-- BEGIN INDEX TOP CONTENT (only on the front page, hide when paged) -->
<!-- BEGIN INCLUDE FEATURED AREA -->
<div class="index-main-wrapper">
    <div class="featured-big-wrapper">
        <div class="featured-big-inner">

        <!-- BEGIN LOOP (large featured story) -->
            <div class="featured-stories-wrapper featured-large">

                <div class="featured-stories-inner" style="background-image:url(http://bonfirethemes.com/powerup/one/wp-content/uploads/sites/2/2017/03/ac-origins.jpg);">
                    <div class="featured-stories-bg-gradient">

                        <!-- BEGIN CATEGORY MARKERS -->
                        <div class="category-markers-wrapper">
                            <div class="video-post-marker"></div>
                            <div class="images-post-marker">
                                <div class="images-post-marker-inner"></div>
                            </div>
                        </div>
                        <!-- END CATEGORY MARKERS -->
        
                        <!-- BEGIN MARK HIGHLIGHTED POST -->
                        <!-- END MARK HIGHLIGHTED POST -->
        
                        <a href="http://bonfirethemes.com/powerup/one/2017/03/31/welcome-to-the-wordpress-theme-for-gamers/">
                            <!-- BEGIN CATEGORIES (except 'featured' and 'highlighted') -->
                            <div class="featured-category">Images</div>
                            <div class="featured-category">News</div>
                            <div class="featured-category">Video</div>
                            <!-- END CATEGORIES (except 'featured' and 'highlighted') -->

                            <div class="featured-title-wrapper">
                                <!-- BEGIN COMMENT COUNT (if post has comments) -->
                                <div class="comment-count-bubble">
                                    <span>5</span>
                                </div>
                                <!-- END COMMENT COUNT (if post has comments) -->
                                <h2>Welcome to PowerUp, the WordPress theme crafted for gamers</h2>
                                <div class="featured-author-time">By John Marston // 2 years ago</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END LOOP (large featured story) -->
        </div>
    </div>    

    <div class="featured-small-wrapper">
    <!-- BEGIN LOOP (small featured stories) -->
        <div class="featured-stories-wrapper">
            <div class="featured-stories-inner" style="background-image:url(http://bonfirethemes.com/powerup/one/wp-content/uploads/sites/2/2017/03/cod-ww2.jpg);">
                <div class="featured-stories-bg-gradient">

                    <!-- BEGIN CATEGORY MARKERS -->
                    <div class="category-markers-wrapper">
                        <div class="images-post-marker">
                            <div class="images-post-marker-inner"></div>
                        </div>
                    </div>
                    <!-- END CATEGORY MARKERS -->
        
                    <!-- BEGIN MARK HIGHLIGHTED POST -->
                    <!-- END MARK HIGHLIGHTED POST -->
        
                    <a href="http://bonfirethemes.com/powerup/one/2017/03/31/cross-device-full-screen-touch-enabled-image-gallery/">
                        <!-- BEGIN CATEGORIES (except 'featured' and 'highlighted') -->
                        <div class="featured-category">Images</div>
                        <!-- END CATEGORIES (except 'featured' and 'highlighted') -->

                        <div class="featured-title-wrapper">
                            <!-- BEGIN COMMENT COUNT (if post has comments) -->
                            <div class="comment-count-bubble">
                                <span>1</span>
                            </div>
                            <!-- END COMMENT COUNT (if post has comments) -->
                            <h2>PowerUp: Cross-device, full-screen, touch-enabled image gallery</h2>
                            <div class="featured-author-time">By John Marston // 2 years ago</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="featured-stories-wrapper">
            <div class="featured-stories-inner" style="background-image:url(http://bonfirethemes.com/powerup/one/wp-content/uploads/sites/2/2017/03/destiny-2.jpg);">
                <div class="featured-stories-bg-gradient">
                    <!-- BEGIN CATEGORY MARKERS -->
                    <div class="category-markers-wrapper">
                        <div class="video-post-marker"></div>
        
                    </div>
                    <!-- END CATEGORY MARKERS -->

                    <!-- BEGIN MARK HIGHLIGHTED POST -->
                    <div class="highlighted-post-marker"></div>
                    <!-- END MARK HIGHLIGHTED POST -->

                    <a href="http://bonfirethemes.com/powerup/one/2017/03/31/a-fantastic-promotional-tool-for-twitch-streamers/">
                    <!-- BEGIN CATEGORIES (except 'featured' and 'highlighted') -->
                        <div class="featured-category">News</div>
                        <div class="featured-category">Video</div>
                        <!-- END CATEGORIES (except 'featured' and 'highlighted') -->
                        <div class="featured-title-wrapper">
                            <!-- BEGIN COMMENT COUNT (if post has comments) -->
                            <!-- END COMMENT COUNT (if post has comments) -->
                            <h2>A fantastic promotional tool for Twitch streamers</h2>
                            <div class="featured-author-time">By John Marston // 2 years ago</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- END LOOP (small featured stories) -->
    </div>                
    <!-- END INCLUDE FEATURED AREA -->
                
    <!-- END INDEX TOP CONTENT (only on the front page, hide when paged) -->

    <!-- BEGIN LOOP -->
    <div class="index-loop-wrapper">
        <div class="index-loop-wrapper-inner">
            <div class="necessary-wrapper-for-index">
                <div class="highlighted-posts-marker">
                    Highlighted                    
                    <span class="icon-help-with-circle">
                        <span class="highlighted-posts-tooltip">
                            Color-marked content should be considered essential reading.
                        </span>
                    </span>
                </div>
            </div>
            <div class="blog-index-cat">
                Friday, March 31st                            
            </div>
            <div class="loop-index-top-border"></div>
            <!-- Sample Post -->                                     
            <div class="loop-index-wrapper">
                <a href="http://bonfirethemes.com/powerup/one/2017/03/31/welcome-to-the-wordpress-theme-for-gamers/">
                    <div class="loop-index-inner">
                        <!-- BEGIN COMMENT COUNT (if post has comments) -->
                        <div class="comment-count-bubble"><span>5</span></div>
                        <!-- END COMMENT COUNT (if post has comments) -->

                        <!-- BEGIN FEATURED IMAGE + ICONS -->        
                        <div class="featured-image" style="background-image:url(http://bonfirethemes.com/powerup/one/wp-content/uploads/sites/2/2017/03/ac-origins-400x242.jpg);">

                        <!-- BEGIN CATEGORY MARKERS -->
                            <div class="category-markers-wrapper">
                                <div class="video-post-marker"></div>
                    
                                <div class="images-post-marker">
                                    <div class="images-post-marker-inner"></div>
                                </div>
                            </div>
                            <!-- END CATEGORY MARKERS -->
                
                            <!-- BEGIN MARK HIGHLIGHTED POST -->
                            <!-- END MARK HIGHLIGHTED POST -->

                        </div>
                        <!-- END FEATURED IMAGE + ICONS -->
                        
                        <!-- BEGIN TITLE + DATE -->
                        <div class="title-excerpt-wrapper">
                            <!-- BEGIN TITLE -->
                            <div class="entry-title">
                                <h2>
                                    <!-- BEGIN STICKY POST MARKER -->
                                                            <!-- END STICKY POST MARKER -->
                                    <!-- BEGIN TITLE -->
                                    Welcome to PowerUp, the WordPress theme crafted for gamers                        <!-- END TITLE -->
                                </h2>
                                
                            </div>
                            <!-- END TITLE -->
                            
                            <!-- BEGIN CONTENT -->
                            <div class="post-excerpt">
                                <!-- BEGIN TIME + DATE -->
                                <span class="post-date">3:39 pm, 31st March 2017:</span>
                                <!-- END TIME + DATE -->
                                <!-- BEGIN EXCERPT -->
                                Hello fellow gamers! Thank you so much for taking the time to check out this demo site for PowerUp, the WordPress theme ...                    <!-- END EXCERPT -->
                                <!-- BEGIN READ MORE -->
                                <span class="read-more">Read more</span>
                                <!-- END READ MORE -->
                            </div>
                            <!-- END CONTENT -->
                        </div>
                        <!-- END TITLE + DATE -->

                    </div>
                </a>
            </div>                                                    
            
            <!-- BEGIN INCLUDE PAGINATION -->
            <div class="post-nav">
                <div class="post-nav-inner">
                    <span class='page-numbers current'>1</span>
                    <a class='page-numbers' href='http://bonfirethemes.com/powerup/one/page/2/'>2</a>
                    <a class="next page-numbers" href="http://bonfirethemes.com/powerup/one/page/2/">&gt;</a>
                </div>
            </div>
            <!-- END INCLUDE PAGINATION -->
        </div>
    </div>
    <!-- END LOOP -->
</div>
<!-- End Index Wrap -->
@endsection