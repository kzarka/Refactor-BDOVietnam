        <div class="related-stories-wrapper">
            <h3>CÙNG CHUYÊN MỤC</h3>
            @forelse($related_posts as $related_post)
            <div class="related-stories-inner" style="background-image:url({{ $related_post->banner_image ?? asset('assets/images/default_banner.jpg') }});">
                <div class="related-stories-bg-gradient">
                    <!-- BEGIN CATEGORY MARKERS -->
                    <div class="category-markers-wrapper">
                        <div class="video-post-marker"></div>
                        
                        <div class="images-post-marker">
                            <div class="images-post-marker-inner"></div>
                        </div>
                    </div>
                    <!-- END CATEGORY MARKERS -->
                    
                    <!-- BEGIN MARK HIGHLIGHTED POST -->
                    @if($related_post->hightlight)
                    <div class="highlighted-post-marker"></div>
                    @endif
                    <!-- END MARK HIGHLIGHTED POST -->
                    
                    <a href="{{ $related_post->url }}">
                        <!-- BEGIN CATEGORIES (except 'featured' and 'highlighted') -->
                        @if($related_post->main_category_name)
                         <div class="related-category">{{ $related_post->main_category_name }}</div>
                        @endif
                        <!-- END CATEGORIES (except 'featured' and 'highlighted') -->

                        <div class="related-title-wrapper">
                            <!-- BEGIN COMMENT COUNT (if post has comments) -->
                            <!-- END COMMENT COUNT (if post has comments) -->
                            <h3>{{ $related_post->title }}</h3>
                            <div class="related-author-time">Bởi {{ $related_post->author->fullname ?? $related_post->author->username }} // {{ $related_post->created_from }}</div>
                        </div>
                    </a>
                    
                </div>
            </div>
            @empty
            @endforelse
        </div>