<?php


return [

    'singular' => 'Role',
    'plural' => 'Roles',
    'attributes' => [
        'name' => 'Role Name',
        'display_name:en' => 'Display Name in English',
        'display_name:ar' => 'Display Name in Arabic',
        'permissions' => 'Permissions',
    ],

    'permission_map' => [
        'index' => 'Read :module',
        'show' => 'Show :module',
        'store' => 'Create :module',
        'update' => 'Update :module',
        'destroy' => 'Permanently Delete :module',
        'forceDelete' => 'Soft Delete :module',
        'restore' => 'Restore :module',
        'block' => 'Block :module',
        'unblock' => 'unBlock :module',
        'status' => 'Status :module',
    ],

    'role_map' => [
        'super_admin' => 'Super Admin',
        'admin' => 'Admin',
    ]
];

