<form action="{{ isset($post) ? route('admin.post.update', $post->id) : route('admin.post.store') }}" method="POST" class="validate" enctype="multipart/form-data">
	@csrf
	@if(isset($post))
	@method('PUT')
	@endif
	<div class="form-group">
		<input class="form-control required" id="title" name="title" type="text" placeholder="Nhập tiêu đề" value="{{ old('title') ?? (isset($post->title) ? $post->title : '') }}">
		@if ($errors->has('title'))
            <label id="title-error" class="error is-invalid" for="title">{{ $errors->first('title') }}</label>
        @endif
	</div>
	<div class="form-group">
		<label for="excert">Ảnh</label><br>
			<div class="images-upload">
				@php $image = isset($post->banner_image) ? $post->banner_image : null; @endphp
				<div class="cover-image-button images {{ ($image) ? '' : 'hidden' }}">
					<span class="close-icon"></span>
					<div class="photo-frame">
						<img src="{{ $image ?? '' }}">
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
            <label id="content-error" class="error is-invalid" for="content">{{ $errors->first('content') }}</label>
        @endif
	</div>
	<div class="form-group">
		<label for="excert">Mô Tả</label>
		<textarea class="form-control" name="excert" placeholder="Excert"></textarea>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="city">Chuyên Mục</label>
				<select class="form-control" id="parent_category" name="category[]" placeholder="Chọn category">
					<option value="">Chọn chuyên mục</option>
					@foreach($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="street">Chuyên Mục Con</label>
				<select multiple="" name="category[]" id="category" class="form-control" placeholder="Chọn chuyên mục con" disabled>
              	</select>
			</div>
			<div class="form-group">
				<label for="postal-code">Banner</label>
				<input class="form-control" id="banner" name="banner" type="text" placeholder="Nhập link banner" value="{{ old('banner') ?? (isset($post->banner) ? $post->banner : '') }}">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group ">
				<label for="postal-code">Slug</label>
				<input class="form-control required" id="" name="slug" type="text" placeholder="Slug được tạo tự động" value="{{ old('slug') ?? (isset($post->slug) ? $post->slug : '') }}">
				@if ($errors->has('slug'))
		            <label id="slug-error" class="error is-invalid" for="slug">{{ $errors->first('slug') }}</label>
		        @endif
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
	<div class="form-group">
		<label for="city">Gắn thẻ</label> <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tối thiểu 2 ký tự. Tag quá ngắn hoặc quá dài sẽ bị lược bỏ"></i>
		<input type="text" class="form-control" name="tags" value="{{ isset($post) ? join(',', $post->tags()->pluck('name')->toArray()) : '' }}">
	</div>
</form>

<form class="preview" action="{{ route('admin.post.preview') }}" method="POST" target="_blank">
	@csrf
	<input type="hidden" name="content">
	<input type="hidden" name="title">
</form>