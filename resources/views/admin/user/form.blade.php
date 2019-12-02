@php 
$current_route = null;
if(isset($user)) {
	$current_route = route('admin.user.update', $user->id);
} elseif(isset($self)) {
	$current_route = route('admin.user.self_update');
} else {
	$current_route = route('admin.user.store');
}
@endphp
<form action="{{ $current_route  }}" method="POST" class="validate" enctype="multipart/form-data">
	@csrf
	@if(isset($user))
	@method('PUT')
	@endif
	@php if(isset($self)) $user = $self; @endphp
	<div class="form-group">
		<label for="city">Avatar</label><br>
		<div class="photo-frame">
			<img class="select_photo" src="{{ $user->avatar }}" />
		</div>
		<input class="file_image hidden" name="avatar" type="file">
		<button class="btn btn-primary select mt-1" type="button">Chọn</button>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group ">
				<label for="postal-code">Tên</label>
				<input class="form-control required" id="" name="first_name" type="text" placeholder="Slug Code" value="{{ old('first_name') ?? (isset($user->first_name) ? $user->first_name : '') }}">
				@if ($errors->has('first_name'))
		            <label id="name-error" class="error" for="slug">{{ $errors->first('first_name') }}</label>
		        @endif
			</div>
			<div class="form-group">
				<label for="postal-code">Username</label>
				<input class="form-control" id="username" name="username" type="text" placeholder="Banner" value="{{ old('username') ?? (isset($user->username) ? $user->username : '') }}" readonly>
			</div>
			@if(!$user->authorizeRoles(ROLE_ADMIN) && auth()->user()->authorizeRoles(ROLE_ADMIN))
			<div class="form-group">
				<label for="postal-code">Roles</label><br>
				<select multiple="" name="roles[]" id="category" class="form-control">
					@if(isset($roles))
					@foreach($roles as $role)
					<option value="{{ $role->id }}">{{ $role->display_name }}</option>
					@endforeach
					@endif
              	</select>
			</div>
			@endif
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="street">Họ</label>
				<input class="form-control required" id="" name="last_name" type="text" placeholder="last name" value="{{ old('last_name') ?? (isset($user->last_name) ? $user->last_name : '') }}">
			</div>
			@if(!$user->authorizeRoles(ROLE_ADMIN) && auth()->user()->authorizeRoles(ROLE_ADMIN))
			<div class="form-group col-sm-4 is-submitted">
				<label for="postal-code">Active</label><br>
				<label class="switch switch-label switch-pill switch-success">
					<input class="switch-input active" id="active" name="active" type="checkbox" value="{{ $status = old('active') ?? (isset($user->active) ? $user->active : '') }}"
					{{ $status ? "checked" : '' }}>
					<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
				</label>
			</div>
			@endif
		</div>
	</div>
	<div class="form-group">
		<label for="city">Email</label>
		<input class="form-control required" id="" name="email" type="text" placeholder="Email Code" value="{{ old('email') ?? (isset($user->email) ? $user->email : '') }}">
	</div>
	<div class="form-group">
		<label for="biography">Về Bạn</label>
		<textarea name="biography" class="form-control">{{ $user->biography }}</textarea>
	</div>
	<button class="btn btn-primary save" type="button">Lưu</button>
</form>