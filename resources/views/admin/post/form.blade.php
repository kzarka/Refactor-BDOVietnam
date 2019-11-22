<form action="{{ route('admin.post.store') }}@if(isset($post)) '/' . $post->id @endif" method="POST" class="validate">
	@csrf
	<div class="form-group">
		<input class="form-control" id="title" name="title" type="text" placeholder="Enter title name">
	</div>
	<div class="form-group">
		<label for="content">Content</label>
		<textarea class="form-control" name="content"></textarea>
	</div>
	<div class="form-group">
		<label for="excert">Excert</label>
		<textarea class="form-control" name="excert" placeholder="Excert"></textarea>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group ">
				<label for="postal-code">Slug</label>
				<input class="form-control" id="" name="slug" type="text" placeholder="Slug Code">
			</div>
			<div class="form-group">
				<label for="street">Category</label>
				<input class="form-control" id="category" name="category" type="text" placeholder="Enter category name">
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
		</div>
	</div>
</form>