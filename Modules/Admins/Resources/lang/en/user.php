<?php

return [
    'plural' => 'Users',
    'trashedPlural' => 'Deleted Users',
    'singular' => 'User',
    'empty' => 'There are no users',
    'select' => 'Select user',
    'perPage' => 'Count Results Per Page',
    'filter' => 'Search for user',
    'my_profile' => 'My Profile',
    'actions' => [
        'list' => 'List users',
        'show' => 'Show user',
        'create' => 'Create user',
        'new' => 'New',
        'edit' => 'Edit user',
        'delete' => 'Delete user',
        'save' => 'Save',
        'filter' => 'Filter',
        'block' => 'Block user',
        'unblock' => 'Unblock user',
    ],
    'messages' => [
        'created' => 'The user has been created successfully.',
        'updated' => 'The user has been updated successfully.',
        'deleted' => 'The user has been deleted successfully.',
        'blocked' => 'The user has been blocked successfully.',
        'unblocked' => 'The user has been unblocked successfully.',
        'images_note' => 'Supported types: jpeg, png,jpg | Max File Size:10MB',
        'restored' => 'The user has been restored successfully.',
        'forceDeleted' => 'The user has been deleted permanently successfully.',
    ],
    'attributes' => [
        'name' => 'Name',
        'username' => 'User Name',
        'phone' => 'Phone',
        'email' => 'Email',
        'created_at' => 'The Date Of Join',
        'old_password' => 'Old Password',
        'password' => 'Password',
        'password_confirmation' => 'Password Confirmation',
        'type' => 'User Type',
        'avatar' => 'Avatar',
        'verified' => 'Verified',
        'verified_at' => 'Verified at',
        'can_access' => 'Can login to system?'
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the user ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
        'force' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the user permanently ?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
        "restore" => [
            'title' => 'Attention !',
            'info' => 'Are you sure you want to restore the user ?',
            'confirm' => 'Restore',
            'cancel' => 'Cancel',
        ],
        'block' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to block the user ?',
            'confirm' => 'Block',
            'cancel' => 'Cancel',
        ],
        'unblock' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to unblock the user ?',
            'confirm' => 'Unblock',
            'cancel' => 'Cancel',
        ],
    ],
];
