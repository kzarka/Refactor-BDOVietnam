        <div id="recent-posts-3" class="widget widget_recent_entries">
            <h4 class="widgettitle">Gần Đây</h4>                
            <ul>
                @forelse($recent_posts as $recent_post)
                <li>
                    <!-- BEGIN COMMENT COUNT (if post has comments) -->
                    @if($recent_post_comment_counT = $recent_post->comments()->count())
                    <div class="comment-count-bubble">
                        <span>{{ $recent_post_comment_counT }}</span>
                    </div>
                    @endif
                    <!-- END COMMENT COUNT (if post has comments) -->
        
                    <!-- BEGIN MARK HIGHLIGHTED POST -->
                    <!-- END MARK HIGHLIGHTED POST -->
        
                    <!-- BEGIN CATEGORY MARKERS -->
                    <div class="category-markers-wrapper">
                        <div class="video-post-marker"></div>
            
                        <div class="images-post-marker">
                            <div class="images-post-marker-inner"></div>
                        </div>
                    </div>
                    <!-- END CATEGORY MARKERS -->
        
                    <a class="latest-widget" href="{{ $recent_post->url }}">
                        <!-- BEGIN featured image -->
                        <div class="featured-image">
                            <img width="200" height="200" src="{{ $recent_post->thumbnail }}" class="attachment-widget-thumb size-widget-thumb wp-post-image" alt="" sizes="(max-width: 200px) 100vw, 200px" />
                        </div>
                        <!-- END featured image -->
                        <!-- BEGIN title + date -->
                        <div class="latest-widget-post-title">{{ $recent_post->title }}</div>
                        <div class="latest-widget-date">{{ $recent_post->created_at }}</div>
                        <!-- END title + date -->
                    </a>
                    <!-- BEGIN background line -->
                    <div class="latest-widget-bg-line"></div>
                    <!-- END background line -->
                </li>
                @empty
                @endforelse
            </ul>
        </div>  