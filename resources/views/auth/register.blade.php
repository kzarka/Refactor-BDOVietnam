@extends('layouts.nosidebar')

@section('title', 'Đăng ký')

@section('content')
<div class="login-container ">
    <form method="post" action="{{ route('register') }}">
        {!! csrf_field() !!}
        <div class="form-group">
            <label class="login" for="username"><b>TÊN ĐĂNG NHẬP</b></label>
            <input type="text" class="" name="username" placeholder="Tên đăng nhập..." value="{{ old('username') }}">
            @if ($errors->has('username'))
                <label class="error" for="name">{{ $errors->first('username') }}</label>
            @endif
        </div>
        <div class="form-group">
            <label class="login" for="username"><b>Email</b></label>
            <input type="text" class="" name="email" placeholder="Email..." value="{{ old('email') }}">
            @if ($errors->has('username'))
                <label class="error" for="email">{{ $errors->first('username') }}</label>
            @endif
        </div>
        <div class="form-group">
            <label class="login" for="password"><b>MẬT KHẨU</b></label>
            <input type="text" class="" name="password" placeholder="Password...">
            @if ($errors->has('password'))
                <label class="error" for="name">{{ $errors->first('password') }}</label>
            @endif
        </div>
        <div class="form-group">
            <label class="login" for="username"><b>NHẬP LẠI MẬT KHẨU</b></label>
            <input type="text" id="password-confirm" class="" name="password_confirmation" placeholder="Re-Password...">
            @if ($errors->has('username'))
                <label class="error" for="name">{{ $errors->first('username') }}</label>
            @endif
        </div>
        <button class="btn btn-submit" type="submit">Đăng ký</button>
    </form>
</div>
@endsection

@section('footer_scripts')
    @if(config('settings.reCaptchStatus'))
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endif
@endsection