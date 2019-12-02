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
    $trail->push('Bài Viết Của Tôi', route('admin.post.index'));
});

Breadcrumbs::for('admin.post.create', function ($trail) {
    $trail->parent('admin.post.index');
    $trail->push('Tạo Post', route('admin.post.create'));
});

Breadcrumbs::for('admin.post.edit', function ($trail, $post) {
    $trail->parent('admin.post.index');
    $trail->push('Chỉnh Sửa: ' . $post->title, route('admin.post.edit', $post->id));
});

Breadcrumbs::for('admin.post.approve', function ($trail) {
    $trail->parent('admin.post.index');
    $trail->push('Phê Duyệt', route('admin.post.approve'));
});

Breadcrumbs::for('admin.post.manage', function ($trail) {
    $trail->parent('admin.post.index');
    $trail->push('Quản Lý', route('admin.post.manage'));
});

Breadcrumbs::for('admin.user.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Users', route('admin.user.index'));
});

Breadcrumbs::for('admin.user.edit', function ($trail) {
    $trail->parent('admin.user.index');
    $trail->push('Cập Nhật User', route('admin.user.index'));
});

Breadcrumbs::for('admin.user.profile', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Profile', route('admin.user.profile'));
});

Breadcrumbs::for('admin.user.self_update', function ($trail) {
    $trail->parent('admin.user.profile');
    $trail->push('Cập Nhật Profile', route('admin.user.self_update'));
});