@extends('layouts.nosidebar')

@section('title', 'Home Page')

@section('body-class', 'error404')

@section('content')

<div class="notfound_wrap">
    <div class="notfound_msg">
        <p class="img_area"></p>
        <p class="text_area">
        	<span class="text01">Trang bạn yêu cầu không tồn tại<br>Vui lòng thử lại</span>
        </p>
        <a class="button-404" href="{{ url('') }}">TRANG CHỦ</a>
    </div>
</div>


@endsection