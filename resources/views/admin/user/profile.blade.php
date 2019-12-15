@extends('admin.layouts.main')

@section('title', 'Profile')

@section('content')
<div class="card">
	<div class="card-body">
		<div class="container">
		    <div class="profile-body">
                <center>
                	<div class="profile-avatar">
                		<img src="{{ $user->avatar != '' ? $user->avatar : asset('assets/images/default_user.png') }}" name="aboutme" width="140" height="140" border="0" class="img-circle">
                		<span class="avatar-status badge-success" title="{{ $user->username }} đang hoạt động"></span>
                	</div>
                	<h3 class="media-heading">{{ $user->full_name }} <small>{{ $user->roles()->first()->display_name }}</small></h3>
                	<span class="badge badge-danger">{{ $user->posts()->count() }} Bài Viết</span>
                    <span class="badge badge-warning">{{ $user->comments()->count() }} Bình Luận</span>
                    <span class="badge badge-success">{{ $user->getRank() }}</span>
                </center>
                <hr>
                <center>
                <p class="text-left"><strong>Tiểu Sử: </strong><br>{{ $user->biography }}</p>
                <br>
                </center>
                @if(auth()->user()->id === $user->id)
                <a href="{{ route('admin.user.self_update') }}" class="btn btn-danger btn-block"><i class="icon-settings"></i> Cập Nhật</a>
                @endif
                <hr>
                <div class="recent-post">
                    @forelse($activities as $activity)
                	<div class="list-group-item list-group-item-accent-danger list-group-item-divider">
						<div>{{ $activity->action_name }} -<strong> {{ $activity->verb }} {{ isset($activity->myself) ? $activity->myself : '' }}</strong></div>
						<small class="text-muted mr-3">
						<i class="icon-calendar"></i>&nbsp; {{ $activity->update_from }}</small>
						<small class="text-muted">
							<i class="icon-home"></i>&nbsp; HN
						</small>
						<div class="avatars-stack mt-2">
							<div class="avatar avatar-xs"></div>
						</div>
					</div>
                    @empty
                    @endforelse
                </div>
            </div>
		</div> <!-- /container -->  
	</div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
	const BASE_API = '{!! route('admin.post.store') !!}';
</script>
<script src="{{ asset('assets/admin/js/user/user.js') }}"></script>
@endpush