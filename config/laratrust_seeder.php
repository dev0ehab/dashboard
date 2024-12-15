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

    'modules' => [
        'allergens' => 'menus',
        'meal_categories' => 'menus',
        'plan_categories' => 'subscriptions',
        'plans' => 'subscriptions',
        'contact-us' => 'settings',
        'zones' => 'deliveries',
        'shifts' => 'deliveries',
    ],

    'roles_structure' => [
        'super_admin' => [
            'admins' => 'c,r,u,d,s,b,ub,re,f',
            'users' => 'c,r,u,d,s,b,ub,re,f',
            'roles' => 'c,r,u,d,s,b,ub,st',
            'countries' => 'c,r,u,d,s,st',
            'branches' => 'c,r,u,d,s,st',
            'allergens' => 'c,r,u,d,s,st',
            'meal_categories' => 'c,r,u,d,s,st',
            'plan_categories' => 'c,r,u,d,s,st',
            'plans' => 'c,r,u,d,s,st',
            'settings' => 'r,u',
            'contact-us' => 'r,d,s',
            'deliveries' => 'c,r,u,d,s,b,ub,re,f',
            'shifts' => 'c,r,u,d,s,st',
            'zones' => 'c,r,u,d,s,st',
        ],
    ],

    'permissions_map' => [
        'c' => 'store',
        'r' => 'index',
        'u' => 'update',
        'd' => 'destroy',
        's' => 'show',
        // 'dl' => 'download',
        // 'so' => 'sort',
        // 'rt' => 'readTrashed',
        // 'a' => 'attach',
        'st' => 'status',
        'b' => 'block',
        'ub' => 'unblock',
        're' => 'restore',
        'f' => 'forceDelete',
    ]
];
