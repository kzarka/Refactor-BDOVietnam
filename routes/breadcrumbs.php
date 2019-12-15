<?php

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('admin.category.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Category', route('admin.category.index'));
});

Breadcrumbs::for('admin.game.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Game', route('admin.game.index'));
});

Breadcrumbs::for('admin.post.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Bài viết của tôi', route('admin.post.index'));
});

Breadcrumbs::for('admin.post.create', function ($trail) {
    $trail->parent('admin.post.index');
    $trail->push('Tạo post', route('admin.post.create'));
});

Breadcrumbs::for('admin.post.edit', function ($trail, $post) {
    $trail->parent('admin.post.index');
    $trail->push('Chỉnh sửa: ' . $post->title, route('admin.post.edit', $post->id));
});

Breadcrumbs::for('admin.post.approve', function ($trail) {
    $trail->parent('admin.post.index');
    $trail->push('Phê duyệt', route('admin.post.approve'));
});

Breadcrumbs::for('admin.post.manage', function ($trail) {
    $trail->parent('admin.post.index');
    $trail->push('Quản lý', route('admin.post.manage'));
});

Breadcrumbs::for('admin.user.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Users', route('admin.user.index'));
});

Breadcrumbs::for('admin.user.edit', function ($trail) {
    $trail->parent('admin.user.index');
    $trail->push('Cập nhật user', route('admin.user.index'));
});

Breadcrumbs::for('admin.user.profile', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile', route('admin.user.profile'));
});

Breadcrumbs::for('admin.user.self_update', function ($trail) {
    $trail->parent('admin.user.profile');
    $trail->push('Cập nhật profile', route('admin.user.self_update'));
});

Breadcrumbs::for('admin.setting.sys_var', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('System Variable', route('admin.setting.sys_var'));
});

Breadcrumbs::for('admin.comment.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Bình luận', route('admin.comment.index'));
});

Breadcrumbs::for('admin.log.activity', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Log Activity', route('admin.log.activity'));
});