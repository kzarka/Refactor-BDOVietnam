@extends('layouts.nosidebar')

@section('title', 'Đăng Nhập')

@section('content')
<div class="login-container ">
	<form method="get" id="searchform" action="http://bonfirethemes.com/powerup/one/">
		<label for="uname"><b>Username</b></label>
	    <input type="text" class="test" name="s" id="s" placeholder="Username...">
	    <label for="password"><b>Password</b></label>
	    <input type="text" class="test" name="s" id="s" placeholder="Password...">
	    <button class="btn btn-submit" type="submit">Login</button>
	</form>
</div>
@endsection