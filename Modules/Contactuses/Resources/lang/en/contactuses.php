<?php


return [

    'singular' => 'Contactus',
    'plural' => 'Contactuses',
    'attributes' => [
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'dial_code' => 'Dial Code',
        'message' => 'Message',
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

    'contactus_map' => [
        'super_admin' => 'Super Admin',
        'admin' => 'Admin',
    ]
];

