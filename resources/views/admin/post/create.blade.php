@extends('admin.layouts.main')

@section('title', 'Tạo Bài Viết')

@push('after_styles')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
	<div class="col-xl-10 col-sm-12">
		<div class="card">
			<div class="card-header">
				<strong>Form</strong>
				<div class="pull-right"><button class="btn btn-success preview mr-2" type="button">Preview</button><button class="btn btn-primary save">Lưu</button></div>
			</div>
			<div class="card-body">
				@include('admin.post.form')
			</div>
		</div>
	</div>
</div>
@endsection

@push('modals')
<!-- Modal Remove image -->
<div class="modal form fade" id="p_remove_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-warning" role="document">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Xóa Ảnh?</h4>
          		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">×</span>
          		</button>
        	</div>
	        <div class="modal-body">
	          	<p>Bạn có muốn gỡ ảnh này?</p>
	        </div>
	        <div class="modal-footer">
	          	<button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
	          	<button class="btn btn-secondary" id="confirm_remove" type="button" data-dismiss="modal">Có</button>
	        </div>
      	</div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal form fade" id="p_preview_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Preview</h4>
          		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">×</span>
          		</button>
        	</div>
	        <div class="modal-body">
	          	<img class="center preview" src="" >
	        </div>
	        <div class="modal-footer">
	          	<button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
	        </div>
      	</div>
    </div>
</div>
@endpush

@push('scripts')
<script type="text/javascript">
	const child_categories = {!! json_encode($child_categories) !!};
</script>
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('assets/admin/js/post/create.js') }}"></script>
@endpush