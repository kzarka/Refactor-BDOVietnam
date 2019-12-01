@extends('admin.layouts.main')

@section('title', 'Post')

@section('content')
<div class="card">
	<div class="card-header"><i class="fa fa-align-justify"></i> Posts</div>
	<div class="card-body">
		<table class="table table-responsive-sm table-striped">
			<thead>
				<tr>
					<th></th>
					<th>Name</th>
					<th>Slug</th>
					<th>Category</th>
					<th>Author</th>
					<th>Public</th>
					<th>Approved</th>
					<th>Created</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($posts as $post)
				<tr data-id="{{ $post->id }}">
					<td class="thumbnail">
						@if($post->thumbnail)
						<img src="{{ $post->thumbnail }}" />
						@endif
					</td>
					<td class="name">{{ $post->title }}</td>
					<td class="slug">{{ $post->slug }}</td>
					<td class="category">
						@php $categories = $post->categories; @endphp
						@forelse($categories as $cat)
						<span class="badge badge-danger">{{ $cat->name }}</span>
						@empty
						@endforelse
					</td>
					<td class="author">{{ $post->author_name }}</td>
					<td class="public">
						@if($post->public)
						<span class="badge badge-success" data-active="1">Yes</span>
						@else
						<span class="badge badge-danger" data-active="0">No</span>
						@endif
					</td>
					<td class="approve">
						@if($post->approved)
						<span class="badge badge-success" data-active="1">Approved</span>
						@else
						<span class="badge badge-danger" data-active="0">Waiting</span>
						@endif
					</td>
					<td class="register">{{ $post->created_at }}</td>
					<td>
						@if($post->canApprove())
						<form class="approve" action="{{ route('admin.post.approve') }}" method="POST">
							@csrf
							<input type="hidden" name="id" value="{{ $post->id }}">
						</form>
						<button class="btn btn-success approve" href="" title="Approve this post">
							<i class="fa fa-check"></i>
						</button>
						@endif
						@if($post->canDelete())
						<button class="btn btn-danger delete" type="button" title="Delete this post">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        <form class="delete" action="{{ route('admin.post.destroy', $post->id) }}" method="POST">
							@csrf
							@method('DELETE')
						</form>
                        @endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $posts->links('admin.partials.paginator') }}
	</div>
</div>
@endsection

@push('modals')

<!-- Modal Delete -->
<div class="modal form fade" id="p_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<!-- End Modal Delete -->
<!-- Modal Approve -->
<div class="modal form fade" id="p_approve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-success" role="document">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Approve?</h4>
          		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">×</span>
          		</button>
        	</div>
	        <div class="modal-body">
	          	<p>Do you want approve record?</p>
	        </div>
	        <div class="modal-footer">
	          	<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
	          	<button class="btn btn-secondary" id="confirm_approve" type="button">Yes</button>
	        </div>
      	</div>
    </div>
</div>
@endpush

@push('scripts')
<script type="text/javascript">
	const BASE_API = '{!! route('admin.post.store') !!}';
</script>
<script src="{{ asset('assets/admin/js/post/post.js') }}"></script>
@endpush