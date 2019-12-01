@extends('layouts.main')

@section('title', $category->name)

@push('after-style')
<style type="text/css">
    .index-main-wrapper { margin-top: -75px; }
</style>
@endpush

@section('content')
<div class="index-loop-wrapper">
    <div class="index-loop-wrapper-inner">
        <!-- BEGIN HIGHLIGHTED POSTS MARKER -->
        <div class="highlighted-posts-marker">Highlighted
        	<span class="icon-help-with-circle">
                <span class="highlighted-posts-tooltip">
                    Color-marked content should be considered essential reading.
                </span>
            </span>
        </div>
        <!-- END HIGHLIGHTED POSTS MARKER -->
    
        <!-- BEGIN CATEGORY -->
        <div class="showing">
            <span>Chuyên Mục</span> {{ $category->name }}
        </div>
        <!-- END CATEGORY -->
        <div class="loop-index-top-border"></div>
        @forelse($posts as $post)
        <!-- BEGIN LOOP -->
		<div class="loop-index-wrapper">
			<a href="{{ $post->url }}">
	    		<div class="loop-index-inner">
	        		<!-- BEGIN COMMENT COUNT (if post has comments) -->
	        		@if($comment_count = $post->comments()->count())
	                <div class="comment-count-bubble">
	                	<span>{{ $comment_count }}</span>
	            	</div>
	            	@endif
	            	<!-- END COMMENT COUNT (if post has comments) -->
	        		<!-- BEGIN FEATURED IMAGE + ICONS -->        
	        		<div class="featured-image" style="background-image:url({{ $post->banner ?? asset('assets/images/default_banner.jpg') }});">
	            		<!-- BEGIN CATEGORY MARKERS -->
	            		<div class="category-markers-wrapper">
	                        <div class="video-post-marker"></div>
	                        <div class="images-post-marker">
	                        	<div class="images-post-marker-inner"></div>
	                    	</div>
	                	</div>
	            		<!-- END CATEGORY MARKERS -->
	            
	            		<!-- BEGIN MARK HIGHLIGHTED POST -->
                		@if($post->hightlight)
                		<div class="highlighted-post-marker"></div>
                		@endif
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
	                    		{{ $post->title }}
	                    		<!-- END TITLE -->
	                		</h2>
	            		</div>
	            		<!-- END TITLE -->
	            
		                <!-- BEGIN CONTENT -->
		                <div class="post-excerpt">
		                    <!-- BEGIN TIME + DATE -->
		                    <span class="post-date">
		                        3:39 pm, 31st March 2017:
		                    </span>
		                    <!-- END TIME + DATE -->
		                    <!-- BEGIN EXCERPT -->
		                    {{ $post->excert }} ...
		                    <!-- END EXCERPT -->
		                    <!-- BEGIN READ MORE -->
		                    <span class="read-more">Đọc tiếp</span>
		                    <!-- END READ MORE -->
		                </div>
		                <!-- END CONTENT -->
		            </div>
		            <!-- END TITLE + DATE -->
	    		</div>
			</a>
		</div>
		<!-- END LOOP  -->
		@empty
		@endforelse

        <!-- BEGIN INCLUDE PAGINATION -->
		{{ $posts->links('partials.paginator') }}
		<!-- END INCLUDE PAGINATION -->
    </div>
</div>
@endsection

@push('after_scripts')
<script type='text/javascript' src="{{ asset('assets/js/comment-reply.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/js/post/post.js') }}"></script>
@endpush