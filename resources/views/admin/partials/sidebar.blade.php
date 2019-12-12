<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>
            <li class="nav-title">Manager</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fa fa-newspaper-o"></i> Bài viết
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.post.index') }}">
                        <i class="fa fa-book"></i> Bài viết</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.post.create') }}">
                        <i class="nav-icon icon-note"></i> Tạo bài viết</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.comment.index') }}">
                <i class="fa fa-comments"></i> Bình luận</a>
            </li>
            @if(Auth::user()->authorizeRoles([ROLE_ADMIN, ROLE_MOD]))
            <li class="nav-title">Extras</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="fa fa-newspaper-o"></i> Quản lý Post
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.post.approve') }}">
                            <i class="fa fa-flash"></i> Phê duyệt @if($unapproved_post_count)<span class="badge badge-danger" title="{{ $unapproved_post_count }} post(s) need to be approve">{{ $unapproved_post_count }}</span>@endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.post.manage') }}">
                            <i class="fa fa-calendar-check-o"></i> Quản lý
                        </a>
                    </li>
                </ul>
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
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="nav-icon icon-user"></i> Users
                </a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-note"></i> Settings
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.setting.sys_var') }}">
                            <i class="nav-icon icon-user"></i> System Variable
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @include('admin.partials.sidebar.system')
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>