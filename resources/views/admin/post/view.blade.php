@extends('layouts.main')

@section('title', $post['title'])

@section('body_class', 'wide')

@section('content')
<div class="single-wrapper">
    <div class="single-wrapper-inner">        
        <!-- BEGIN CUSTOM FIELD FOR EMBEDDABLE CONTENT -->
        <div class="featuredembed-container"></div>
        <!-- END CUSTOM FIELD FOR EMBEDDABLE CONTENT -->
        
        <!-- BEGIN SHORTCODE OUTSIDE THE LOOP -->
        <div class="shortcode-wrapper"></div>
        <!-- END SHORTCODE OUTSIDE THE LOOP -->

        <!-- BEGIN CONTENT -->
        <div class="entry-content-wrapper">
            <div class="entry-content">

                <!-- BEGIN TITLE -->
                <div class="entry-title">
                    <a href="{{ $post->url }}" title="Permalink to {{ $post->title }}" rel="bookmark">
                        <h1>{{ $post['title'] }}</h1>
                    </a>
                </div>
                <!-- END TITLE -->

                <!-- BEGIN DATE -->
                <div class="post-date">
                    27 Tháng 2, 2019 <span>|</span>
                </div>
                <!-- END DATE -->

                <!-- BEGIN POST CAT -->
                <div class="post-cat">
                    Danh Mục: 
                    <a href="" rel="category tag">Tên Danh Mục</a>
                    <span>, </span>
                    <a href="" rel="category tag">Tên Danh Mục</a>
                </div>
                <!-- END POST CAT -->

                <!-- BEGIN CONTENT  -->
                <article class="post type-post status-publish format-standard has-post-thumbnail hentry category-featured category-images category-news category-video tag-bonfire-themes tag-powerup tag-wordpress">
                    <!-- BEGIN CONTENT -->
                     {!! $post['content'] !!}
                    <!-- END CONTENT -->

                    <!-- BEGIN NAVIGATION -->
                    <div class="link-pages">
                    </div>
                    <!-- END NAVIGATION -->
                </article>
                <!-- END CONTENT -->
                
                <!-- BEGIN EDIT LINK -->
                                <!-- END EDIT LINK -->
                
                <!-- BEGIN AUTHOR, AVATAR, DESCRIPTION -->
                <div class="post-author">
                    <!-- BEGIN AUTHOR AVATAR -->
                    <a href="" rel="author">
                        <img alt="" src="{{ asset('assets/images/user/default.png') }}" class="avatar avatar-74 photo" height="74" width="74">
                    </a>
                    <!-- END AUTHOR AVATAR -->
                    <!-- BEGIN AUTHOR DESCRIPTION -->
                    <div class="author-desc-wrapper">
                        <span class="author-name">
                            <a href="" rel="author"> Admin</a>
                        </span><span class="author-position">, Admin</span>
                        <div class="author-description">
                            I’m selfish, impatient and a little insecure. I make mistakes, I am out of control and at times hard to handle. But if you can’t handle me at my worst, then you sure as hell don’t deserve me at my best  
                        </div>
                    </div>
                    <!-- END AUTHOR DESCRIPTION -->
                </div>
                <!-- END AUTHOR, AVATAR, DESCRIPTION -->
                
                <!-- BEGIN TINY DIVIDER -->
                <div class="tiny-divider"></div>
                <!-- END TINY DIVIDER -->
                <!-- BEGIN POST TAGS -->
                <div class="post-tag">
                    Tag: <a href="" rel="tag">Black Desert</a><span>, </span>
                </div>
                <!-- END POST TAGS -->
            </div>
        </div>
        <!-- END CONTENT -->

        <!-- BEGIN RELATED STORIES -->
        <!-- END RELATED STORIES -->
        <!-- BEGIN COMMENTS -->
        <!-- END COMMENTS -->
    </div>
    <!-- /.single-wrapper-inner -->
</div>
@endsection

@push('after_scripts')
<script type='text/javascript' src="{{ asset('assets/js/comment-reply.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/js/post/post.js') }}"></script>
@endpush