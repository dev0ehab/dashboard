<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => false,

    'roles_structure' => [
        'super_admin' => [
            'admins' => 'c,r,u,d,s,b,re,f',
            'roles' => 'c,r,u,d,s',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        's' => 'show',
        // 'dl' => 'download',
        // 'so' => 'sort',
        // 'rt' => 'readTrashed',
        // 'a' => 'attach',
        // 'st' => 'status',
        'b' => 'block',
        're' => 'restore',
        'f' => 'forceDelete',
    ]
];
