@extends('layouts.main')

@section('title', $post->title)

@section('body_class', 'wide')
@section('content')
<div class="single-wrapper">
    <div class="single-wrapper-inner">

        <!-- BEGIN FEATURED IMAGE -->
        <!-- <div class="featured-image"> -->
        <!-- </div> -->
        <!-- END FEATURED IMAGE -->
        
        <!-- BEGIN CUSTOM FIELD FOR EMBEDDABLE CONTENT -->
        <div class="featuredembed-container"></div>
        <!-- END CUSTOM FIELD FOR EMBEDDABLE CONTENT -->

        <!-- BEGIN CONTENT -->
        <div class="entry-content-wrapper">
            <div class="entry-content">

                <!-- BEGIN TITLE -->
                <div class="entry-title">
                    <a href="{{ $post->url }}" title="Permalink to {{ $post->title }}" rel="bookmark">
                        <h1>{{ $post->title }}</h1>
                    </a>
                </div>
                <!-- END TITLE -->

                <!-- BEGIN DATE -->
                <div class="post-date">
                {{ $post->author->fullname ?? $post->author->username }}<span>|</span> {{ $post->created_at_date_first }}<span>|</span><i class="fa fa-eye"></i> {{ $post->view_count }} lượt xem<span>|</span>
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
                <article class="post type-post status-publish format-standard has-post-thumbnail hentry category-featured category-images category-news ">
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
                        <img alt="" src="{{ $post->author->avatar ?? asset('assets/images/user/default.png') }}" class="avatar avatar-74 photo" height="74" width="74">
                    </a>
                    <!-- END AUTHOR AVATAR -->
                    <!-- BEGIN AUTHOR DESCRIPTION -->
                    <div class="author-desc-wrapper">
                        <span class="author-name">
                            <a href="" rel="author"> {{ $post->author->fullname ?? $post->author->username }}</a>
                        </span><span class="author-position">, {{ ($role = $post->author->roles()->first()) ? $role->display_name : '' }}</span>
                        <div class="author-description">
                            {{ $post->author->biography ?? '^.^' }}
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
                    Tag: 
                    @if($post_tags = $post->tags)
                    @php 
                    $numItems = count($post_tags);
                    $i = 0;
                    @endphp
                    @foreach($post_tags as $post_tag)
                    <a href="{{ $post_tag->url }}" rel="tag">{{ $post_tag->name }}</a>@if(++$i != $numItems)<span>, </span>@endif
                    @endforeach
                    @endif
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
<script type='text/javascript' src="{{ asset('assets/js/post/post.js') }}"></script>
@endpush