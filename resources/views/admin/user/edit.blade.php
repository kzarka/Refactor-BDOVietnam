@extends('admin.layouts.main')

@section('title', 'Cập Nhật Profile')

@push('after_styles')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
	<div class="col-xl-10 col-sm-12">
		<div class="card">
			<div class="card-header">
				<strong>Cập Nhật Hồ Sơ</strong>
			</div>
			<div class="card-body">
				@include('admin.user.form')
			</div>
		</div>
	</div>
</div>
@endsection

@push('modals')
<!-- Modal Preview -->
<div class="modal form fade" id="u_preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
	          	<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
	        </div>
      	</div>
    </div>
</div>
@endpush

@push('scripts')
@if(auth()->user()->authorizeRoles(ROLE_ADMIN) && isset($user))
<script type="text/javascript">
	const roles = {!! $user->roles()->pluck('roles.id'); !!}
	$('select[name="roles[]"]').val(roles).trigger('change');
</script>
@endif
<script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/user/form.js') }}"></script>
@endpush