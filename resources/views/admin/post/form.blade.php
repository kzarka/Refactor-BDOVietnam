<form action="{{ isset($post) ? route('admin.post.update', $post->id) : route('admin.post.store') }}" method="POST" class="validate">
	@csrf
	@if(isset($post))
	@method('PUT')
	@endif
	<div class="form-group">
		<input class="form-control" id="title" name="title" type="text" placeholder="Enter title name" value="{{ old('title') ?? (isset($post->title) ? $post->title : '') }}">
		@if ($errors->has('title'))
            <label id="name-error" class="error" for="title">{{ $errors->first('title') }}</label>
        @endif
	</div>
	<div class="form-group">
		<label for="content">Content</label>
		<textarea class="form-control" name="content">{{ old('content') ?? (isset($post->content) ? $post->content : '') }}</textarea>
		@if ($errors->has('content'))
            <label id="name-error" class="error" for="comment">{{ $errors->first('content') }}</label>
        @endif
	</div>
	<div class="form-group">
		<label for="excert">Excert</label>
		<textarea class="form-control" name="excert" placeholder="Excert"></textarea>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group ">
				<label for="postal-code">Slug</label>
				<input class="form-control" id="" name="slug" type="text" placeholder="Slug Code" value="{{ old('slug') ?? (isset($post->slug) ? $post->slug : '') }}">
				@if ($errors->has('slug'))
		            <label id="name-error" class="error" for="slug">{{ $errors->first('slug') }}</label>
		        @endif
			</div>
			<div class="form-group">
				<label for="street">Category</label>
				<select multiple="" name="category" id="category" class="form-control">
					@foreach($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
              	</select>
			</div>
			<div class="form-group">
				<label for="postal-code">Banner</label>
				<input class="form-control" id="banner" name="banner" type="text" placeholder="Banner">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="city">Game</label>
				<select class="form-control" id="game" name="game" placeholder="Enter game">
					<option value="">Select game</option>
					@foreach($games as $game)
					<option value="{{ $game->id }}">{{ $game->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="city">Thumbnail</label>
				<input class="form-control" id="thumbnail" type="text" name="thumbnail" placeholder="Enter Thumbnail">
			</div>
			<div class="form-group col-sm-4 is-submitted">
				<label for="postal-code">Public</label><br>
				<label class="switch switch-label switch-pill switch-success">
					<input class="switch-input public" id="status" name="public" type="checkbox">
					<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
				</label>
			</div>
		</div>
	</div>
</form>