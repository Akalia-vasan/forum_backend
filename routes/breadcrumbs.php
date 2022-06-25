<?php

Breadcrumbs::for('login', function ($trail) {
    $trail->push('Login', route('login'));
});

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Dashboard', route('home'));
});
// User breadcrumbs
Breadcrumbs::for('admin.auth.user.index', function ($trail) {
    $trail->push(__('User Management'), route('admin.auth.user.index'));
});

Breadcrumbs::for('admin.auth.user.create', function ($trail) {
    $trail->parent('admin.auth.user.index');
    $trail->push('User Create', route('admin.auth.user.create'));
});

Breadcrumbs::for('admin.auth.user.edit', function ($trail, $id) {
    $trail->parent('admin.auth.user.index');
    $trail->push('User Edit', route('admin.auth.user.edit', $id));
});

Breadcrumbs::for('admin.auth.user.show', function ($trail, $id) {
    $trail->parent('admin.auth.user.index');
    $trail->push('User View', route('admin.auth.user.show', $id));
});

// Role breadcrumbs
Breadcrumbs::for('admin.auth.role.index', function ($trail) {
    $trail->push(__('Role Management'), route('admin.auth.role.index'));
});

Breadcrumbs::for('admin.auth.role.create', function ($trail) {
    $trail->parent('admin.auth.user.index');
    $trail->push('Role Create', route('admin.auth.role.create'));
});

Breadcrumbs::for('admin.auth.role.edit', function ($trail, $id) {
    $trail->parent('admin.auth.role.index');
    $trail->push('Role Edit', route('admin.auth.role.edit', $id));
});

// Company breadcrumbs
Breadcrumbs::for('admin.auth.company.index', function ($trail) {
    $trail->push(__('Company Management'), route('admin.auth.company.index'));
});

Breadcrumbs::for('admin.auth.company.create', function ($trail) {
    $trail->parent('admin.auth.company.index');
    $trail->push('Company Create', route('admin.auth.company.create'));
});

Breadcrumbs::for('admin.auth.company.edit', function ($trail, $id) {
    $trail->parent('admin.auth.company.index');
    $trail->push('Company Edit', route('admin.auth.company.edit', $id));
});

Breadcrumbs::for('admin.auth.company.show', function ($trail, $id) {
    $trail->parent('admin.auth.company.index');
    $trail->push('Company View', route('admin.auth.company.show', $id));
});

// Employee breadcrumbs
Breadcrumbs::for('admin.auth.employee.index', function ($trail) {
    $trail->push(__('Employee Management'), route('admin.auth.employee.index'));
});

Breadcrumbs::for('admin.auth.employee.create', function ($trail) {
    $trail->parent('admin.auth.employee.index');
    $trail->push('Employee Create', route('admin.auth.employee.create'));
});

Breadcrumbs::for('admin.auth.employee.edit', function ($trail, $id) {
    $trail->parent('admin.auth.employee.index');
    $trail->push('Employee Edit', route('admin.auth.employee.edit', $id));
});

Breadcrumbs::for('admin.auth.employee.show', function ($trail, $id) {
    $trail->parent('admin.auth.employee.index');
    $trail->push('Employee View', route('admin.auth.employee.show', $id));
});