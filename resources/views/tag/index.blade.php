@extends('layouts.main')

@section('title', 'Danh sách thẻ')

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
            <span>Tag</span> Danh sách tag
        </div>
        <!-- END CATEGORY -->
        <div class="loop-index-top-border"></div>
        <div class="tagcloud" style="margin-top: 20px">
        @forelse($tags as $tag)
        <!-- BEGIN LOOP -->
            <a href="{{ $tag->url }}" class="tag" title="{{ $tag->posts->count() }} bài viết" style="font-size: 8pt;">{{ $tag->name }}</a>
		<!-- END LOOP  -->
		@empty
		@endforelse
		</div>
    </div>
</div>
@endsection