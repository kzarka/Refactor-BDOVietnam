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
    $trail->push('My Posts', route('admin.post.index'));
});

Breadcrumbs::for('admin.post.create', function ($trail) {
    $trail->parent('admin.post.index');
    $trail->push('Create Post', route('admin.post.create'));
});

Breadcrumbs::for('admin.post.edit', function ($trail, $post) {
    $trail->parent('admin.post.index');
    $trail->push('Edit Post: ' . $post->title, route('admin.post.edit', $post->id));
});

Breadcrumbs::for('admin.post.approve', function ($trail) {
    $trail->parent('admin.post.index');
    $trail->push('Approve Posts', route('admin.post.approve'));
});

Breadcrumbs::for('admin.post.manage', function ($trail) {
    $trail->parent('admin.post.index');
    $trail->push('Manage Posts', route('admin.post.manage'));
});

Breadcrumbs::for('admin.user.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Users', route('admin.user.index'));
});

Breadcrumbs::for('admin.user.edit', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Update User', route('admin.user.index'));
});