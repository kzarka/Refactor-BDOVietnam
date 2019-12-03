<form action="{{ isset($post) ? route('admin.post.update', $post->id) : route('admin.post.store') }}" method="POST" class="validate" enctype="multipart/form-data">
	@csrf
	@if(isset($post))
	@method('PUT')
	@endif
	<div class="form-group">
		<input class="form-control required" id="title" name="title" type="text" placeholder="Nhập tiêu đề" value="{{ old('title') ?? (isset($post->title) ? $post->title : '') }}">
		@if ($errors->has('title'))
            <label id="name-error" class="error" for="title">{{ $errors->first('title') }}</label>
        @endif
	</div>
	<div class="form-group">
		<label for="excert">Ảnh</label><br>
			<div class="images-upload">
				<div class="cover-image-button images hidden">
					<span class="close-icon"></span>
					<div class="photo-frame">
						<img src="">
					</div>
				</div>
				<button class="btn btn-success add-image" type="button">Thêm</button>
			</div>
		<input type="file" name="images" class="hidden">
	</div>
	<div class="form-group">
		<label for="content">Nội Dung</label>
		<textarea class="form-control required" name="content">{{ old('content') ?? (isset($post->content) ? $post->content : '') }}</textarea>
		@if ($errors->has('content'))
            <label id="name-error" class="error" for="comment">{{ $errors->first('content') }}</label>
        @endif
	</div>
	<div class="form-group">
		<label for="excert">Mô Tả</label>
		<textarea class="form-control" name="excert" placeholder="Excert"></textarea>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group ">
				<label for="postal-code">Slug</label>
				<input class="form-control required" id="" name="slug" type="text" placeholder="Slug" value="{{ old('slug') ?? (isset($post->slug) ? $post->slug : '') }}">
				@if ($errors->has('slug'))
		            <label id="name-error" class="error" for="slug">{{ $errors->first('slug') }}</label>
		        @endif
			</div>
			<div class="form-group">
				<label for="street">Chuyên Mục</label>
				<select multiple="" name="category[]" id="category" class="form-control">
					@foreach($categories as $category)
					@if($children = $category->children)
					<optgroup label="{{ $category->name }}">
						@foreach($children as $child)
						<option value="{{ $child->id }}">{{ $child->name }}</option>
						@endforeach
					</optgroup>
					@endif
					@endforeach
              	</select>
			</div>
			<div class="form-group">
				<label for="postal-code">Banner</label>
				<input class="form-control" id="banner" name="banner" type="text" placeholder="Nhập link banner" value="{{ old('banner') ?? (isset($post->banner) ? $post->banner : '') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="city">Game</label>
				<select class="form-control" id="game" name="game" placeholder="Chọn game">
					<option value="">Select game</option>
					@foreach($games as $game)
					<option value="{{ $game->id }}" selected>{{ $game->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="city">Thumbnail</label>
				<input class="form-control" id="thumbnail" type="text" name="thumbnail" placeholder="Nhập link thumbnail" value="{{ old('thumbnail') ?? (isset($post->thumbnail) ? $post->thumbnail : '') }}">
			</div>
			<div class="form-group col-sm-4 is-submitted">
				<label for="postal-code">Public</label><br>
				<label class="switch switch-label switch-pill switch-success">
					<input class="switch-input public" id="public" name="public" type="checkbox" value="{{ $status = old('public') ?? (isset($post->public) ? $post->public : '') }}"
					{{ $status ? "checked" : '' }}>
					<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
				</label>
			</div>
		</div>
	</div>
</form>

<form class="preview" action="{{ route('admin.post.preview') }}" method="POST" target="_blank">
	@csrf
	<input type="hidden" name="content">
	<input type="hidden" name="title">
</form>