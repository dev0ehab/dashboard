<?php

return [
    'plural' => 'Admins',
    'types' => [
        \Modules\Admins\Entities\User::ADMIN_TYPE => 'Admin',
    ],
    'messages' => [
        'block' => 'This admin is blocked,please check with your administration',
        'verified' => 'This admin is not verified,we have sent you an sms with code',
        'password' => 'Password is incorrect, please enter the correct password',
    ],
];
