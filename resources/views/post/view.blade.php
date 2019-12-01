@extends('layouts.main')

@section('title', $post->title)

@section('content')
<div class="single-wrapper">
    <div class="single-wrapper-inner">

        <!-- BEGIN FEATURED IMAGE -->
        <div class="featured-image">
            <!-- BEGIN FEATURED IMAGE -->
            <a href="{{ $post->url }}">
                <img width="720" height="405" src="{{ $post->banner }}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" sizes="(max-width: 720px) 100vw, 720px">
            </a>
            <!-- END FEATURED IMAGE -->
        </div>
        <!-- END FEATURED IMAGE -->
        
        <!-- BEGIN CUSTOM FIELD FOR EMBEDDABLE CONTENT -->
        <div class="featuredembed-container"></div>
        <!-- END CUSTOM FIELD FOR EMBEDDABLE CONTENT -->
        
        <!-- BEGIN SHORTCODE OUTSIDE THE LOOP -->
        <div class="shortcode-wrapper"></div>
        <!-- END SHORTCODE OUTSIDE THE LOOP -->

        <!-- BEGIN CONTENT -->
        <div class="entry-content-wrapper">
            <div class="entry-content">
                <!-- BEGIN DATE -->
                <div class="post-date">
                    {{ $post->created_at }}<span>|</span>
                </div>
                <!-- END DATE -->

                <!-- BEGIN POST CAT -->
                <div class="post-cat">
                    Danh Mục: 
                    @if($post_cats = $post->categories)
                    @php $i = 0; @endphp
                    @foreach($post_cats as $post_cat)
                    @php $i++; @endphp
                    <a href="{{ $post_cat->url }}" rel="category tag">{{ $post_cat->name }}</a>
                    @if($i != (count($post_cats)))
                    <span>, </span>
                    @endif
                    @endforeach
                    @endif
                </div>
                <!-- END POST CAT -->

                <!-- BEGIN CONTENT  -->
                <article id="post-265" class="post-265 post type-post status-publish format-standard has-post-thumbnail hentry category-featured category-images category-news category-video tag-bonfire-themes tag-powerup tag-wordpress">
                    <!-- BEGIN TITLE -->
                    <div class="entry-title">
                        <a href="{{ $post->url }}" title="Permalink to {{ $post->title }}" rel="bookmark">
                            <h1>{{ $post->title }}</h1>
                        </a>
                    </div>
                    <!-- END TITLE -->
        
                    <!-- BEGIN CONTENT -->
                     {!! $post->content !!}
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
                        <img alt="" src="{{ $post->author->avatar ?? asset('assets/images/default_user.png') }}" class="avatar avatar-74 photo" height="74" width="74">
                    </a>
                    <!-- END AUTHOR AVATAR -->
                    <!-- BEGIN AUTHOR DESCRIPTION -->
                    <div class="author-desc-wrapper">
                        <span class="author-name">
                            <a href="" rel="author"> {{ $post->author_name ?? $post->username }}</a>
                        </span><span class="author-position">, {{ ($role = $post->author->roles()->first()) ? $role->display_name : '' }}</span>
                        <div class="author-description">
                            Gamer since Wolfenstein 3D days. Games journalist since 2002. Best job in the world! Follow me on <a href="https://twitter.com/BonfireThemes">Twitter</a>, I'm good fun :)                        
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
                    Tagged: <a href="" rel="tag">Black Desert</a><span>, </span>
                </div>
                <!-- END POST TAGS -->
            </div>
        </div>
        <!-- END CONTENT -->

        <!-- BEGIN RELATED STORIES -->
        @include('post.section.relate_post')
        <!-- END RELATED STORIES -->
        <!-- BEGIN COMMENTS -->
        @include('post.section.comment')
        <!-- END COMMENTS -->
    </div>
    <!-- /.single-wrapper-inner -->
</div>
@endsection

@push('after_scripts')
<script type='text/javascript' src="{{ asset('assets/js/comment-reply.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/js/post/post.js') }}"></script>
@endpush