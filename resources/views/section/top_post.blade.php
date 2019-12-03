    <div class="featured-big-wrapper">
        <div class="featured-big-inner">
        <!-- BEGIN LOOP (large featured story) -->
            <div class="featured-stories-wrapper featured-large">
                @if($top_posts && isset($top_posts[0]))
                <div class="featured-stories-inner" style="background-image:url({{ $top_posts[0]->banner_image ?? asset('assets/images/default_banner.jpg') }});">
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
                        @if($top_posts[0]->hightlight)
                        <div class="highlighted-post-marker"></div>
                        @endif
                        <!-- END MARK HIGHLIGHTED POST -->
        
                        <a href="{{ $top_posts[0]->url }}">
                            <!-- BEGIN CATEGORIES (except 'featured' and 'highlighted') -->
                            @if($cat = $top_posts[0]->categories()->first())
                            <div class="featured-category">{{ $cat->name }}</div>
                            @endif
                            <!-- END CATEGORIES (except 'featured' and 'highlighted') -->

                            <div class="featured-title-wrapper">
                                <!-- BEGIN COMMENT COUNT (if post has comments) -->
                                @if($comment_count = $top_posts[0]->comments()->count())
                                <div class="comment-count-bubble">
                                    <span>{{ $comment_count }}</span>
                                </div>
                                @endif
                                <!-- END COMMENT COUNT (if post has comments) -->
                                <h2>{{ $top_posts[0]->title }}</h2>
                                <div class="featured-author-time">By {{ $top_posts[0]->author_name }} // {{ $top_posts[0]->created_from }}</div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
            </div>
            <!-- END LOOP (large featured story) -->
        </div>
    </div>    

    <div class="featured-small-wrapper">
    <!-- BEGIN LOOP (small featured stories) -->
        <div class="featured-stories-wrapper">
            @if($top_posts && isset($top_posts[1]))
            <div class="featured-stories-inner" style="background-image:url({{ $top_posts[1]->banner_image ?? asset('assets/images/default_banner.jpg') }});">
                <div class="featured-stories-bg-gradient">

                    <!-- BEGIN CATEGORY MARKERS -->
                    <div class="category-markers-wrapper">
                        <div class="images-post-marker">
                            <div class="images-post-marker-inner"></div>
                        </div>
                    </div>
                    <!-- END CATEGORY MARKERS -->
        
                    <!-- BEGIN MARK HIGHLIGHTED POST -->
                    @if($top_posts[1]->hightlight)
                    <div class="highlighted-post-marker"></div>
                    @endif
                    <!-- END MARK HIGHLIGHTED POST -->
        
                    <a href="{{ $top_posts[1]->url }}">
                        <!-- BEGIN CATEGORIES (except 'featured' and 'highlighted') -->
                        @if($cat = $top_posts[1]->categories()->first())
                            <div class="featured-category">{{ $cat->name }}</div>
                        @endif
                        <!-- END CATEGORIES (except 'featured' and 'highlighted') -->

                        <div class="featured-title-wrapper">
                            <!-- BEGIN COMMENT COUNT (if post has comments) -->
                            @if($comment_count = $top_posts[1]->comments()->count())
                            <div class="comment-count-bubble">
                                <span>{{ $comment_count }}</span>
                            </div>
                            @endif
                            <!-- END COMMENT COUNT (if post has comments) -->
                            <h2>{{ $top_posts[1]->title }}</h2>
                            <div class="featured-author-time">By {{ $top_posts[1]->author_name }} // {{ $top_posts[0]->created_from }}</div>
                        </div>
                    </a>
                </div>
            </div>
            @endif
        </div>
        <div class="featured-stories-wrapper">
            @if($top_posts && isset($top_posts[2]))
            <div class="featured-stories-inner" style="background-image:url({{ $top_posts[2]->banner_image ?? asset('assets/images/default_banner.jpg') }});">
                <div class="featured-stories-bg-gradient">

                    <!-- BEGIN CATEGORY MARKERS -->
                    <div class="category-markers-wrapper">
                        <div class="images-post-marker">
                            <div class="images-post-marker-inner"></div>
                        </div>
                    </div>
                    <!-- END CATEGORY MARKERS -->
        
                    <!-- BEGIN MARK HIGHLIGHTED POST -->
                    @if($top_posts[2]->hightlight)
                    <div class="highlighted-post-marker"></div>
                    @endif
                    <!-- END MARK HIGHLIGHTED POST -->
        
                    <a href="{{ $top_posts[2]->url }}">
                        <!-- BEGIN CATEGORIES (except 'featured' and 'highlighted') -->
                        @if($cat = $top_posts[2]->categories()->first())
                            <div class="featured-category">{{ $cat->name }}</div>
                        @endif
                        <!-- END CATEGORIES (except 'featured' and 'highlighted') -->

                        <div class="featured-title-wrapper">
                            <!-- BEGIN COMMENT COUNT (if post has comments) -->
                            @if($comment_count = $top_posts[2]->comments()->count())
                            <div class="comment-count-bubble">
                                <span>{{ $comment_count }}</span>
                            </div>
                            @endif
                            <!-- END COMMENT COUNT (if post has comments) -->
                            <h2>{{ $top_posts[2]->title }}</h2>
                            <div class="featured-author-time">By {{ $top_posts[2]->author_name }} // {{ $top_posts[0]->created_from }}</div>
                        </div>
                    </a>
                </div>
            </div>
            @endif
        </div>
        <!-- END LOOP (small featured stories) -->
    </div>                