@extends('admin.layouts.main')

@section('title', 'Post')

@section('content')
<div class="card">
	<div class="card-header"><i class="fa fa-align-justify"></i> My Posts</div>
	<div class="card-body">
		<table class="table table-responsive-sm table-striped">
			<thead>
				<tr>
					<th></th>
					<th>Tên</th>
					<th>Chuyên Mục</th>
					<th>Tác Giả</th>
					<th>Bình Luận</th>
					<th>Public</th>
					<th>Phê Duyệt</th>
					<th>Ngày Tạo</th>
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
					<td class="name"><a href="{{ route('admin.post.preview', $post->id) }}" target="_blank" title="Xem trước">{{ $post->title }} <i class="fa fa-external-link"></i></a></td>
					<td class="category">
						@php $categories = $post->categories; @endphp
						@forelse($categories as $cat)
						<span class="badge badge-danger">{{ $cat->name }}</span>
						@empty
						@endforelse
					</td>
					<td class="author">{{ $post->author_name }}</td>
					<td class="author"><span class="badge badge-danger">{{ $post->comments()->count() }}</span></td>
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
						@if($post->canModify())
						<a class="btn btn-success edit" href="{{ route('admin.post.edit', $post->id) }}" alt="Edit this post">
							<i class="fa fa-edit"></i>
						</a>
						@endif
						@if($post->canDelete())
						<button class="btn btn-danger delete" type="button">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        <form class="delete" action="{{ route('admin.post.destroy', $post->id) }}" method="POST"  alt="Delete this post">
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
		<a class="btn btn-primary m-1 pull-right create" href="{{ route('admin.post.create') }}">Tạo</a>
	</div>
</div>
@endsection

@push('modals')

<!-- Modal Delete -->
<div class="modal form fade" id="p_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-danger" role="document">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Xóa?</h4>
          		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">×</span>
          		</button>
        	</div>
	        <div class="modal-body">
	          	<p>Bạn có muốn xóa bài viết này?</p>
	        </div>
	        <div class="modal-footer">
	          	<button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
	          	<button class="btn btn-danger" id="confirm_delete" type="button">Có</button>
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
