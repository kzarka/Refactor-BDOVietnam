@extends('admin.layouts.main')

@section('title', 'Home Page 1')

@push('after_styles')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
	<div class="col-xl-10 col-sm-12">
		<div class="card">
			<div class="card-header">
				<strong>Company</strong>
				<small>Form</small>
				<div class="pull-right"><button class="btn btn-primary">Save</button></div>
			</div>
			<div class="card-body">
				@include('admin.post.form')
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/post/create.js') }}"></script>
@endpush