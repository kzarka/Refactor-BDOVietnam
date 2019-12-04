        <li class="nav-item dropdown d-md-down-none">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                <i class="icon-bell"></i>
                @if($unread_count = auth()->user()->unreadNotifications->count())
                <span class="badge badge-pill badge-danger">{{ $unread_count }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg notification">
                <div class="dropdown-header text-center">
                    <strong>Thông Báo</strong>
                </div>
                <a class="dropdown-item item" href="#">
                    <div class="message">
                        <div class="py-3 mr-3 float-left">
                            <div class="avatar">
                                <img class="img-avatar" src="{{ asset('assets/images/user/default.png') }}" alt="admin@bootstrapmaster.com">
                                <span class="avatar-status badge-warning"></span>
                            </div>
                        </div>
                        <div>
                            <small class="text-muted from">John Doe</small>
                            <small class="text-muted float-right mt-1 time">5 minutes ago</small>
                        </div>
                        <div class="small text-muted text-truncate sentence">đã thêm một bình luận mới vào bài viết của bạn</div>
                        <div class="text-truncate font-weight-bold to">Tôi đi code dạo</div>
                    </div>
                </a>
                <a class="dropdown-item text-center load-more" href="#">
                    <strong>Tải thêm</strong>
                </a>
            </div>
        </li>