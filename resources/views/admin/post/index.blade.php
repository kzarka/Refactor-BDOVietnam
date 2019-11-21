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
					<th>Date registered</th>
					<th>Status</th>
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
					<td class="name">{{ $post->name }}</td>
					<td class="slug">{{ $post->slug }}</td>
					<td class="register">{{ $post->created_at }}</td>
					<td class="active">
						@if($post->active)
						<span class="badge badge-success" data-active="1">Active</span>
						@else
						<span class="badge badge-danger" data-active="0">Disabled</span>
						@endif
					</td>
					<td>
						<form action="{{ route('admin.post.destroy', $post->id) }}" method="POST">
							@csrf
							@method('DELETE')
						</form>
						<a class="btn btn-success edit" href="{{ route('admin.post.edit', $post->id) }}">
							<i class="fa fa-edit"></i>
						</a>
						<button class="btn btn-danger delete" type="button">
                            <i class="fa fa-trash-o"></i>
                        </button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $posts->links('partials.paginate') }}
		<button class="btn btn-primary m-1 pull-right create" type="button">Create</button>
	</div>
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
	const BASE_API = '{!! route('admin.post.store') !!}';
</script>
<script src="{{ asset('assets/admin/js/games/post.js') }}"></script>
@endpush