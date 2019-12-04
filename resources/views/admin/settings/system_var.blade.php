@extends('admin.layouts.main')

@section('title', 'System Variable')

@section('content')
<div class="row">
	<div class="col-xl-10 col-sm-12">
		<div class="card">
			<div class="card-header">
				<strong>Form</strong>
			</div>
			<div class="card-body">
				<form action="{{ route('admin.setting.sys_var') }}" method="POST" class="validate">
					@csrf
					@foreach($vars as $var)
					<div class="form-group">
						<label>{{ $var->name }}</label>
						<input type="hidden" name="names[]" value="{{ $var->name }}">
						@if($var->input == 'textarea')
						<textarea class="form-control required" name="values[]" type="text" placeholder="Nhập tiêu đề">{{ $var->value }}</textarea>
						@else
						<input class="form-control required" name="values[]" type="text" placeholder="Nhập tiêu đề" value="{{ $var->value }}">
						@endif
						@if ($errors->has('title'))
				            <label id="name-error" class="error" for="title">{{ $errors->first('title') }}</label>
				        @endif
					</div>
					@endforeach
					<button class="btn btn-success">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection