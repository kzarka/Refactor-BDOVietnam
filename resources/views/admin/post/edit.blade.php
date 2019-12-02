@extends('admin.layouts.main')

@section('title', 'Sửa Bài Viết')

@push('after_styles')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
	<div class="col-xl-10 col-sm-12">
		<div class="card">
			<div class="card-header">
				<strong>Form</strong>
				<div class="pull-right"><button class="btn btn-success preview mr-2" type="button">Preview</button><button class="btn btn-primary save" type="button">Lưu</button></div>
			</div>
			<div class="card-body">
				@include('admin.post.form')
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
	const selected_categories = {!! $post->categories()->pluck('categories.id') !!};
</script>
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/post/edit.js') }}"></script>
@endpush