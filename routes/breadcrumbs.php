<?php

Breadcrumbs::for('login', function ($trail) {
    $trail->push('Login', route('login'));
});

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Dashboard', route('home'));
});
// User breadcrumbs
Breadcrumbs::for('auth.user.index', function ($trail) {
    $trail->push(__('User Management'), route('auth.user.index'));
});

Breadcrumbs::for('auth.user.create', function ($trail) {
    $trail->parent('auth.user.index');
    $trail->push('User Create', route('auth.user.create'));
});

Breadcrumbs::for('auth.user.edit', function ($trail, $id) {
    $trail->parent('auth.user.index');
    $trail->push('User Edit', route('auth.user.edit', $id));
});

Breadcrumbs::for('auth.user.show', function ($trail, $id) {
    $trail->parent('auth.user.index');
    $trail->push('User View', route('auth.user.show', $id));
});

// Role breadcrumbs
Breadcrumbs::for('auth.role.index', function ($trail) {
    $trail->push(__('Role Management'), route('auth.role.index'));
});

Breadcrumbs::for('auth.role.create', function ($trail) {
    $trail->parent('auth.role.index');
    $trail->push('Role Create', route('auth.role.create'));
});

Breadcrumbs::for('auth.role.edit', function ($trail, $id) {
    $trail->parent('auth.role.index');
    $trail->push('Role Edit', route('auth.role.edit', $id));
});

// Post breadcrumbs
Breadcrumbs::for('auth.post.index', function ($trail) {
    $trail->push(__('My Posts'), route('auth.post.index'));
});

Breadcrumbs::for('auth.post.create', function ($trail) {
    $trail->parent('auth.post.index');
    $trail->push('Post Create', route('auth.post.create'));
});

Breadcrumbs::for('auth.post.edit', function ($trail, $id) {
    $trail->parent('auth.post.index');
    $trail->push('Post Edit', route('auth.post.edit', $id));
});

Breadcrumbs::for('auth.post.approval.index', function ($trail) {
    $trail->push(__('Post Approval Management'), route('auth.post.approval.index'));
});


Breadcrumbs::for('auth.post.approval.show', function ($trail, $id) {
    $trail->parent('auth.post.approval.index');
    $trail->push('Post Approval View', route('auth.post.approval.show', $id));
});
Breadcrumbs::for('auth.post.qa', function ($trail, $id) {
    $trail->parent('home');
    $trail->push('Comments', route('auth.post.qa', $id));
});

Breadcrumbs::for('log-viewer::dashboard', function ($trail) {
    $trail->push(__('menus.backend.log-viewer.main'), url('log-viewer'));
});

Breadcrumbs::for('log-viewer::logs.list', function ($trail) {
    $trail->parent('log-viewer::dashboard');
    $trail->push(__('menus.backend.log-viewer.logs'), url('/log-viewer/logs'));
});

Breadcrumbs::for('log-viewer::logs.show', function ($trail, $date) {
    $trail->parent('log-viewer::logs.list');
    $trail->push($date, url('log-viewer/logs/'.$date));
});

Breadcrumbs::for('log-viewer::logs.filter', function ($trail, $date, $filter) {
    $trail->parent('log-viewer::logs.show', $date);
    $trail->push(ucfirst($filter), url('log-viewer/'.$date.'/'.$filter));
});