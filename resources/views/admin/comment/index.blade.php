@extends('admin.layouts.main')

@section('title', 'Bình luận')

@section('content')
<div class="card">
	@forelse ($comments as $comment)
	<div class="list-group-item list-group-item-accent-{{ CSS_STATUS[rand(1,4)] }} list-group-item-divider">
		<div><strong>{{ $comment->author ? $comment->author->fullname : $comment->name }}</strong></div>
		<div class="avatars-stack mt-2 mb-1">
			{{ $comment->comment }}
		</div>
		<small class="text-muted mr-3"><i class="fa fa-clock-o"></i>&nbsp; {{ $comment->created_from }}</small>
		<small class="text-muted">
			<i class="fa fa-book"></i>&nbsp; <a href="{{ $comment->post->url }}">{{ $comment->post->title }}</a>
		</small>
	</div>
	@empty
	
	@endforelse
	{{ $comments->links('admin.partials.paginator') }}
</div>
@endsection

@push('modals')

<!-- Modal Delete -->
<div class="modal form fade" id="g_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-danger" role="document">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Delete?</h4>
          		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">×</span>
          		</button>
        	</div>
	        <div class="modal-body">
	          	<p>Do you want to delete this record?</p>
	        </div>
	        <div class="modal-footer">
	          	<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
	          	<button class="btn btn-danger" id="confirm_delete" type="button">Yes</button>
	        </div>
      	</div>
    </div>
</div>
@endpush

@push('scripts')
<script type="text/javascript">
	const BASE_API = '{!! route('admin.category.store') !!}';
</script>
<script src="{{ asset('assets/admin/js/category/category.js') }}"></script>
@endpush