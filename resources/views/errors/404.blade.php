@extends('layouts.nosidebar')

@section('title', 'Home Page')

@section('body-class', 'error404')

@section('content')	
<h1 class="entry-title">
    Oops, nothing to see here...
</h1>

<div class="entry-content">
	Looks like you discovered a page that does not exist anymore, or perhaps it never did.
</div>

<a class="button-404" href="/">GO TO FRONT PAGE</a>

@endsection