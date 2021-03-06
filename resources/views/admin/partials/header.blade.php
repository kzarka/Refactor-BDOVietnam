<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
        <img class="navbar-brand-full" src="{{ asset('assets/admin/images/brand/logo.svg') }}" width="89" height="25" alt="CoreUI Logo">
        <img class="navbar-brand-minimized" src="{{ asset('assets/admin/images/brand/sygnet.svg') }}" width="30" height="30" alt="CoreUI Logo">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="{{ route('admin.user.profile', '') }}">Profile</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link" href="#">Cài Đặt</a>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        @include('admin.partials.header.notification')
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar" src="{{ auth()->user()->getUserAvatarSmallThumbnail() }}" alt="admin@bootstrapmaster.com">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>{{ auth()->user()->fullname ?? auth()->user()->username }}</strong>
                </div>
                <a class="dropdown-item" href="{{ route('admin.user.profile', '') }}">
                    <i class="fa fa-user"></i> Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-wrench"></i> Settings
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
                    
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>