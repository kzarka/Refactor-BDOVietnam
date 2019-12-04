<ol class="breadcrumb">
@if (count($breadcrumbs))
    <!-- Breadcrumb Menu-->
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !$loop->last)
            <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
        @else
            <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
        @endif
    @endforeach
@endif
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="{{ route('admin.dashboard') }}">
                <i class="icon-graph"></i>  Dashboard</a>
            <a class="btn" href="#">
                <i class="icon-settings"></i> Cài đặt</a>
        </div>
    </li>
</ol>