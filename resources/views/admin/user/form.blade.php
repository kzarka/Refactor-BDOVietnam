<form action="{{ isset($user) ? route('admin.user.update', $user->id) : route('admin.user.store') }}" method="POST" class="validate" enctype="multipart/form-data">
	@csrf
	@if(isset($user))
	@method('PUT')
	@endif
	<div class="form-group">
		<label for="city">Avatar</label><br>
		<div class="photo-frame">
			<img class="select_photo" src="{{ $user->avatar ?? asset('assets/images/default_user.png') }}" />
		</div>
		<input class="file_image hidden" name="avatar" type="file">
		<button class="btn btn-primary select mt-1" type="button">Select</button>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group ">
				<label for="postal-code">First Name</label>
				<input class="form-control required" id="" name="first_name" type="text" placeholder="Slug Code" value="{{ old('first_name') ?? (isset($user->first_name) ? $user->first_name : '') }}">
				@if ($errors->has('first_name'))
		            <label id="name-error" class="error" for="slug">{{ $errors->first('first_name') }}</label>
		        @endif
			</div>
			<div class="form-group">
				<label for="postal-code">Username</label>
				<input class="form-control" id="username" name="username" type="text" placeholder="Banner" value="{{ old('username') ?? (isset($user->username) ? $user->username : '') }}" readonly>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="street">Last Name</label>
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
		<label for="description">Description</label>
		<textarea name="description" class="form-control">{{ $user->description }}</textarea>
	</div>
	<button class="btn btn-primary save" type="button">Save</button>
</form>