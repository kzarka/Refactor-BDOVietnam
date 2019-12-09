@extends('layouts.nosidebar')

@section('title', 'Đăng Nhập')

@push('after-style')
<link rel='stylesheet' href="{{ asset('assets/css/login.css') }}" type="text/css" media="all" />
@endpush

@section('content')
<div class="login-container ">
	<form method="post" action="{{ route('login') }}">
		{!! csrf_field() !!}
		<label class="login" for="username"><b>TÊN ĐĂNG NHẬP</b></label>
	    <input type="text" class="" name="login" placeholder="Tên đăng nhập..." value="{{ old('login') }}">
	    @if ($errors->has('username'))
            <label class="error" for="name">{{ $errors->first('username') }}</label>
        @endif
	    <label class="login" for="password"><b>MẬT KHẨU</b></label>
	    <input type="password" class="" name="password" placeholder="Password...">
	    @if ($errors->has('password'))
            <label class="error" for="name">{{ $errors->first('password') }}</label>
        @endif
	    <button class="btn btn-submit" type="submit">Đăng nhập</button>

	    <span style="color: #fff;"> Chưa có tài khoản?</span> <a href="{{ route('register') }}">Đăng ký</a>!
	</form>
</div>
@endsection