@extends('admin.layouts.main')

@section('title', 'Profile')

@section('content')
<div class="card">
	<div class="card-header"><i class="fa fa-align-justify"></i> Profile</div>
	<div class="card-body">
		
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
	const BASE_API = '{!! route('admin.post.store') !!}';
</script>
<script src="{{ asset('assets/admin/js/user/user.js') }}"></script>
@endpush