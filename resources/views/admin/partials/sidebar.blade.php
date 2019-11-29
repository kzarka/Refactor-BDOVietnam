<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>
            <li class="nav-title">Settings</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon icon-user"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon icon-lock"></i> Roles
                </a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-note"></i> Post
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.post.index') }}">
                        <i class="nav-icon icon-note"></i> Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.post.create') }}">
                        <i class="nav-icon icon-note"></i> Create Post</a>
                    </li>
                </ul>
            </li>
            @if(Auth::user()->authorizeRoles([ROLE_ADMIN, ROLE_MOD]))
            <li class="nav-title">Extras</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.post.approve') }}">
                <i class="nav-icon icon-note"></i> Approve Post <span class="badge badge-danger">PRO</span></a>
            </li>
            @endif
            @if(Auth::user()->authorizeRoles([ROLE_ADMIN]))
            <!-- Super Power -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.game.index') }}">
                    <i class="nav-icon icon-game-controller"></i> Games
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.category.index') }}">
                    <i class="nav-icon icon-game-controller"></i> Category
                </a>
            </li>
            @endif
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>