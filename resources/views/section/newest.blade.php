
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
                Mới Nhất                           
            </div>
            <div class="loop-index-top-border"></div>
            <!-- Sample Post -->                                     
             @forelse($newests as $newest)                                
            <div class="loop-index-wrapper">
                @php $cat = $newest->categories()->first() @endphp
                <a href="{{ $newest->url }}">
                    <div class="loop-index-inner">
                        <!-- BEGIN COMMENT COUNT (if post has comments) -->
                        @if($comment_count = $newest->comments()->count())
                        <div class="comment-count-bubble"><span>{{ $comment_count }}</span></div>
                        @endif
                        <!-- END COMMENT COUNT (if post has comments) -->

                        <!-- BEGIN FEATURED IMAGE + ICONS -->        
                        <div class="featured-image" style="background-image:url({{ $newest->banner ?? asset('assets/images/default_banner.jpg') }});">

                        <!-- BEGIN CATEGORY MARKERS -->
                            <div class="category-markers-wrapper">
                                <div class="video-post-marker"></div>
                    
                                <div class="images-post-marker">
                                    <div class="images-post-marker-inner"></div>
                                </div>
                            </div>
                            <!-- END CATEGORY MARKERS -->
                
                            <!-- BEGIN MARK HIGHLIGHTED POST -->
                            @if($newest->hightlight)
                            <div class="highlighted-post-marker"></div>
                            @endif
                            <!-- END MARK HIGHLIGHTED POST -->

                        </div>
                        <!-- END FEATURED IMAGE + ICONS -->
                        
                        <!-- BEGIN TITLE + DATE -->
                        <div class="title-excerpt-wrapper">
                            <!-- BEGIN TITLE -->
                            <div class="entry-title">
                                <h2>{{ $newest->title }}</h2>
                                
                            </div>
                            <!-- END TITLE -->
                            
                            <!-- BEGIN CONTENT -->
                            <div class="post-excerpt">
                                <!-- BEGIN TIME + DATE -->
                                <span class="post-date">{{ $newest->created_at_text_full }}:</span>
                                {{ $newest->excert }} ... 
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