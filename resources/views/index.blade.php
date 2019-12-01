@extends('layouts.main')

@section('title', 'Home Page')

@section('content')
<!-- BEGIN INDEX TOP CONTENT (only on the front page, hide when paged) -->
<div class="index-main-wrapper">
    <!-- BEGIN INCLUDE TOP POST AREA -->
    @include('section.top_post')
    <!-- END INCLUDE TOP POST AREA -->
    <div class="index-loop-wrapper">
        <div class="index-loop-wrapper-inner">
        <!-- BEGIN INCLUDE NEWEST -->
        @include('section.newest')
        <!-- END INCLUDE NEWEST -->
        
        <!-- BEGIN INCLUDE MOST VIEWED -->
        @include('section.most_viewed')
        <!-- END INCLUDE MOST VIEWED -->
        </div>
    </div>
</div>
<!-- End Index Wrap -->
@endsection