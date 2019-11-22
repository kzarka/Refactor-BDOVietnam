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
    $trail->push('Posts', route('admin.post.index'));
});

Breadcrumbs::for('admin.post.create', function ($trail) {
    $trail->parent('admin.post.index');
    $trail->push('Create Post', route('admin.post.create'));
});

Breadcrumbs::for('admin.post.edit', function ($trail, $post) {
    $trail->parent('admin.post.index');
    $trail->push('Edit Post: ' . $post->name, route('admin.post.edit', $post->id));
});