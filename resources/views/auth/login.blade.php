@extends('layouts.nosidebar')

@section('title', 'Home Page')

@section('content')
<form method="get" id="searchform" action="http://bonfirethemes.com/powerup/one/">
    <input type="text" name="s" id="s" placeholder="Search...">
    <div class="search-button-wrapper"><input type="submit" id="searchsubmit" value=""></div>
</form>
@endsection