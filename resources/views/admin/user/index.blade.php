@extends('admin.layouts.main')

@section('title', 'User Manager')

@section('content')
<div class="card">
	<div class="card-header"><i class="fa fa-align-justify"></i> Users</div>
	<div class="card-body">
		<table class="table table-responsive-sm table-hover table-outline mb-0">
			<thead class="thead-light">
				<tr>
					<th></th>
					<th>User</th>
					<th>Email</th>
					<th>Roles</th>
					<th>Status</th>
					<th>Posts</th>
					<th>Comments</th>
					<th>Activity</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr data-id="{{ $user->id }}">
					<td class="text-center">
						<div class="avatar">
							<img class="img-avatar" src="{{ $user->thumbnail !== '' ? $user->thumbnail : asset('assets/images/default_user.png')  }}" alt="admin@bootstrapmaster.com">
							<span class="avatar-status badge-success"></span>
						</div>
					</td>
					<td>
						<div><a href="{{ $user->url_admin }}" target="_blank">{{ $user->fullname }}</a></div>
						<div class="small text-muted">
						<span>New</span> | Registered: {{ $user->created_at }}</div>
					</td>
					<td class="email">{{ $user->email }}</td>
					<td class="role">
						@php $roles = $user->roles ?? []; @endphp
						@forelse($roles as $role)
						<span class="badge badge-success">{{ $role->name }}</span>
						@empty
						
						@endforelse
					</td>
					<td class="status">
						@if($user->active)
						<span class="badge badge-success" data-active="1">Active</span>
						@else
						<span class="badge badge-danger" data-active="0">Banner</span>
						@endif
					</td>
					<td class="post"><span class="badge badge-danger" data-active="0">{{ $user->posts()->count() }}</span></td>
					<td class="comment"><span class="badge badge-danger" data-active="0">{{ $user->comments()->count() }}</span></td>
					<td>
						<div class="small text-muted">Last login</div>
						<strong>{{ $user->last_login_from }}</strong>
					</td>
					<td>
						<a class="btn btn-success edit" href="{{ route('admin.user.edit', $user->id) }}" title="Edit this user">
							<i class="fa fa-edit"></i>
						</a>
						@if(!$user->authorizeRoles(ROLE_ADMIN))
						@if(!$user->banned_until || now()->greaterThan($user->banned_until))
						<button class="btn btn-danger ban" type="button" title="Ban this user">
                            <i class="fa fa-legal"></i>
                        </button>
                        @endif

                        @if($user->banned_until && now()->lessThan($user->banned_until))
                        <button class="btn btn-success ban" type="button" title="Lift ban this user">
                            <i class="fa fa-hourglass-end"></i>
                        </button>
                        @endif
                        @endif

                        @if($user->canDelete())
						<button class="btn btn-danger delete" type="button" title="Delete this user">
                            <i class="fa fa-trash-o"></i>
                        </button>
                        <form class="delete" action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
							@csrf
							@method('DELETE')
						</form>
						@endif
						<form class="lift" action="{{ route('admin.user.lift', $user->id) }}" method="POST">
							@csrf
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $users->links('admin.partials.paginator') }}
	</div>
</div>
@endsection

@push('modals')

<!-- Modal Delete -->
<div class="modal form fade" id="u_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-danger" role="document">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Delete?</h4>
          		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">×</span>
          		</button>
        	</div>
	        <div class="modal-body">
	          	<p>Do you want to delete this user?</p>
	        </div>
	        <div class="modal-footer">
	          	<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
	          	<button class="btn btn-danger" id="confirm_delete" type="button">Yes</button>
	        </div>
      	</div>
    </div>
</div>

<!-- Modal Status -->
<div class="modal form fade" id="u_ban" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-success" role="document">
      	<div class="modal-content">
        	<div class="modal-header">
          		<h4 class="modal-title">Ban?</h4>
          		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
            		<span aria-hidden="true">×</span>
          		</button>
        	</div>
	        <div class="modal-body">
	          	<p>Do you want to ban this user?</p>
	          	<form class="ban form-inline" action="{{ route('admin.user.ban') }}">
  					<label class="sr-only" for="inlineFormInputName2">Ban</label>
  					<input type="hidden" name="user_id">
  					<input type="text" class="form-control mb-2 mr-sm-2" name="banned_until" placeholder="Ban util">
  					days
  				</form>
	        </div>
	        <div class="modal-footer">
	          	<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
	          	<button class="btn btn-secondary" id="confirm_ban" type="button">Yes</button>
	        </div>
      	</div>
    </div>
</div>
@endpush

@push('scripts')
<script type="text/javascript">
	const BASE_API = '{!! route('admin.post.store') !!}';
</script>
<script src="{{ asset('assets/admin/js/user/user.js') }}"></script>
@endpush