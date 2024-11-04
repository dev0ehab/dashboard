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
        'create' => 'Create :module',
        'read' => 'Read :module',
        'update' => 'Update :module',
        'delete' => 'Permanently Delete :module',
        'show' => 'Show :module',
        'forceDelete' => 'Soft Delete :module',
        'restore' => 'Restore :module',
        'block' => 'Block :module',
    ],

    'role_map' => [
        'super_admin' => 'Super Admin',
        'admin' => 'Admin',
    ]
];

