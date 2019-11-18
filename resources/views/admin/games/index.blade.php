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
				<tr>
					<td>
						@if($game->thumbnail)
						<img src="{{ $game->thumbnail }}" />
						@endif
					</td>
					<td>{{ $game->name }}</td>
					<td>{{ $game->slug }}</td>
					<td>{{ $game->created_at }}</td>
					<td>
						@if($game->active)
						<span class="badge badge-success">Active</span>
						@else
						<span class="badge badge-danger">Disabled</span>
						@endif
					</td>
					<td>
						<a class="btn btn-success" href="#">
							<i class="fa fa-edit"></i>
						</a>
						<button class="btn btn-danger" type="submit">
                            <i class="fa fa-trash-o"></i>
                        </button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $games->links() }}
	</div>
</div>

<!-- Modal Form -->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Modal title</h4>
          		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">×</span>
          		</button>
        	</div>
	        <div class="modal-body">
	          	<p>One fine body…</p>
	        </div>
	        <div class="modal-footer">
	          	<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
	          	<button class="btn btn-primary" type="button">Save changes</button>
	        </div>
      	</div>
    </div>
</div>
@endsection