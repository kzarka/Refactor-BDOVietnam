@extends('admin.layouts.main')

@section('title', 'Category')

@section('content')
<div class="card">
	<div class="card-header"><i class="fa fa-align-justify"></i> Categories</div>
	<div class="card-body">
		<table class="table table-responsive-sm table-striped">
			<thead>
				<tr>
					<th></th>
					<th>Name</th>
					<th>Slug</th>
					<th>Parent</th>
					<th>Date registered</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@forelse ($categories as $category)
				<tr data-id="{{ $category->id }}">
					<td class="banner">
						@if($category->thumbnail)
						<img src="{{ $category->banner }}" />
						@endif
					</td>
					<td class="name">{{ $category->name }}</td>
					<td class="slug">{{ $category->slug }}</td>
					<td class="parent" data-parent-id="{{ $category->parent_id }}">{{ $category->parent_name }}</td>
					<td class="register">{{ $category->created_at }}</td>
					<td class="active">
						@if($category->active)
						<span class="badge badge-success" data-active="1">Active</span>
						@else
						<span class="badge badge-danger" data-active="0">Disabled</span>
						@endif
					</td>
					<td>
						<form action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
							@csrf
							@method('DELETE')
						</form>
						<button class="btn btn-success edit" type="button">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger delete" type="button">
                            <i class="fa fa-trash-o"></i>
                        </button>
					</td>
				</tr>
				@empty
				<tr data-id="">
					<td class="banner"></td>
					<td class="name"></td>
					<td class="slug"></td>
					<td class="parent" data-parent-id=""></td>
					<td class="register"></td>
					<td class="active"></td>
					<td>
						<form action="" method="POST">
							@csrf
							@method('DELETE')
						</form>
						<button class="btn btn-success edit" type="button">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger delete" type="button">
                            <i class="fa fa-trash-o"></i>
                        </button>
					</td>
				</tr>
				@endforelse
			</tbody>
		</table>
		{{ $categories->links('admin.partials.paginator') }}
		<button class="btn btn-primary m-1 pull-right create" type="button">Create</button>
	</div>
</div>
@endsection

@push('modals')
<!-- Modal Form -->
<div class="modal form fade" id="g_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Category Form</h4>
          		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">×</span>
          		</button>
        	</div>
        	<form class="validate" action="" method="POST">
        		@csrf
		        <div class="modal-body">
		        	<label class="server-error"></label>
		          	<div class="form-group is-submitted">
						<label for="company">Name</label>
						<input class="form-control required" id="name" name="name" type="text" placeholder="Enter category name">
						<label id="name-error" class="is-invalid" for="name" style=""></label>
					</div>
					<div class="form-group is-submitted">
						<label for="company">Banner</label>
						<input class="form-control" id="banner" name="banner" type="text" placeholder="Banner">
						<label id="banner-error" class="is-invalid" for="banner" style=""></label>
					</div>
					<div class="form-group is-submitted">
						<label for="company">Parent</label>
						<select class="form-control" id="parent" name="parent_id" placeholder="Parent">
						</select>
						<label id="parent_id-error" class="is-invalid" for="parent" style=""></label>
					</div>
					<div class="row">
						<div class="form-group col-sm-8 is-submitted">
							<label for="city">Slug</label>
							<input class="form-control required" id="slug" name="slug" type="text" placeholder="Slug">
							<label id="slug-error" class="is-invalid" for="slug" style=""></label>
						</div>
						<div class="form-group col-sm-4 is-submitted">
							<label for="postal-code">Status</label><br>
							<label class="switch switch-label switch-pill switch-success">
								<input class="switch-input" id="status" name="active" type="checkbox">
								<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
							</label>
						</div>
					</div>
		        </div>
		        <div class="modal-footer">
		          	<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
		          	<button class="btn btn-primary submit" type="button">Save changes</button>
		        </div>
		    </form>
      	</div>
    </div>
</div>
<!-- End Modal Form -->

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