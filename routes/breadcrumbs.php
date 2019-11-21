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