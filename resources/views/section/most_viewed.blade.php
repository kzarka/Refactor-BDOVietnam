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
            <div class="blog-index-section">
                Xem Nhiều                          
            </div>
            <div class="loop-index-top-border"></div>
            <!-- Sample Post -->
            @forelse($top_posts as $top_post)                                
            <div class="loop-index-wrapper">
                @php $cat = $top_post->categories()->first() @endphp
                <a href="{{ $top_post->url }}">
                    <div class="loop-index-inner">
                        <!-- BEGIN COMMENT COUNT (if post has comments) -->
                        @if($comment_count = $top_post->comments()->count())
                        <div class="comment-count-bubble"><span>{{ $comment_count }}</span></div>
                        @endif
                        <!-- END COMMENT COUNT (if post has comments) -->

                        <!-- BEGIN FEATURED IMAGE + ICONS -->        
                        <div class="featured-image" style="background-image:url({{ $top_post->banner ?? asset('assets/images/default_banner.jpg') }});">

                        <!-- BEGIN CATEGORY MARKERS -->
                            <div class="category-markers-wrapper">
                                <div class="video-post-marker"></div>
                    
                                <div class="images-post-marker">
                                    <div class="images-post-marker-inner"></div>
                                </div>
                            </div>
                            <!-- END CATEGORY MARKERS -->
                
                            <!-- BEGIN MARK HIGHLIGHTED POST -->
                            @if($top_post->hightlight)
                            <div class="highlighted-post-marker"></div>
                            @endif
                            <!-- END MARK HIGHLIGHTED POST -->

                        </div>
                        <!-- END FEATURED IMAGE + ICONS -->
                        
                        <!-- BEGIN TITLE + DATE -->
                        <div class="title-excerpt-wrapper">
                            <!-- BEGIN TITLE -->
                            <div class="entry-title">
                                <h2>{{ $top_post->title }}</h2>
                                
                            </div>
                            <!-- END TITLE -->
                            
                            <!-- BEGIN CONTENT -->
                            <div class="post-excerpt">
                                <!-- BEGIN TIME + DATE -->
                                <span class="post-date">{{ $top_post->created_at_text_full }}:</span>
                                {{ $top_post->excert }} ... 
                                <span class="read-more">{{ trans('commons.read_more') }}</span>
                                <!-- END READ MORE -->
                            </div>
                            <!-- END CONTENT -->
                        </div>
                        <!-- END TITLE + DATE -->

                    </div>
                </a>
            </div>      
            @empty
            @endforelse                                              
            
            <!-- BEGIN INCLUDE PAGINATION -->
            <div class="post-nav">
                <div class="post-nav-inner">
                    
                </div>
            </div>
            <!-- END INCLUDE PAGINATION -->