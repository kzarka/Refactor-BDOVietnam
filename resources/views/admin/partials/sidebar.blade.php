<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
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
                <a class="nav-link" href="{{ route('admin.category.index') }}">
                    <i class="nav-icon icon-game-controller"></i> Category
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon icon-lock"></i> Roles
                </a>
            </li>
            <!-- Super Power -->
            <li class="nav-title">Extras</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.game.index') }}">
                    <i class="nav-icon icon-game-controller"></i> Games
                </a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>