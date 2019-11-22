@extends('admin.layouts.main')

@section('title', 'Home Page 1')

@section('content')
<div class="card">
	<div class="card-header"><i class="fa fa-align-justify"></i> Games</div>
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
				@foreach($games as $game)
				<tr data-id="{{ $game->id }}">
					<td class="thumbnail">
						@if($game->thumbnail)
						<img src="{{ $game->thumbnail }}" />
						@endif
					</td>
					<td class="name">{{ $game->name }}</td>
					<td class="slug">{{ $game->slug }}</td>
					<td class="register">{{ $game->created_at }}</td>
					<td class="active">
						@if($game->active)
						<span class="badge badge-success" data-active="1">Active</span>
						@else
						<span class="badge badge-danger" data-active="0">Disabled</span>
						@endif
					</td>
					<td>
						<form action="{{ route('admin.game.destroy', $game->id) }}" method="POST">
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
				@endforeach
			</tbody>
		</table>
		{{ $games->links('partials.paginate') }}
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
          		<h4 class="modal-title">Game Form</h4>
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
						<input class="form-control required" id="name" name="name" type="text" placeholder="Enter game name">
						<label id="name-error" class="is-invalid" for="name" style=""></label>
					</div> 
					<div class="form-group is-submitted">
						<label for="company">Thumbnail</label>
						<input class="form-control" id="thumbnail" name="thumbnail" type="text" placeholder="Thumbnail">
						<label id="thumbnail-error" class="is-invalid" for="thumbnail" style=""></label>
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
	const BASE_API = '{!! route('admin.game.store') !!}';
</script>
<script src="{{ asset('assets/admin/js/games/game.js') }}"></script>
@endpush