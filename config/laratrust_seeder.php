<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'superadmin' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'invoice' => 'c,r,u,d',
            'profile' => 'r,u',
            'project' => 'c,r,u,d',
        ],
        'admin' => [
            'users' => 'c,r,u,d',
            'invoice' => 'c,r,u,d',
            'profile' => 'r,u',
            'project' => 'r,u',
        ],
        'vendor' => [
            'profile' => 'r,u',
            'invoice' => 'r',
            'project' => 'r',
        ],
        'customer' => [
            'profile' => 'r,u',
            'invoice' => 'r',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
