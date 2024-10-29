<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'validations' => [
        'failed' => 'These credentials do not match our records.',
        'deleted' => 'This account has been deleted.',
        'blocked' => 'This account has been blocked.',
        'password' => 'The password you entered is incorrect!',
        'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
        'verification' => 'This :attribute is invalid',
        'phone-not-verified' => 'Phone number is not verified',
        'email-not-verified' => 'Email is not verified',
    ],
    'attributes' => [
        'code' => 'verification code',
        'token' => 'verification token',
        'email' => 'email',
        'phone' => 'phone number',
        'username' => 'email or phone number',
        'password' => 'password',
    ],
    'messages' => [
        'register' => 'You have registered successfully',
        'logout' => 'You have logged out successfully',
        'login' => 'You have logged in successfully',
        'notification' => 'Notification status changed successfully',


        'profile' => [
            'change-password' => 'Password changed successfully',
            'preferred-locale' => 'Language changed successfully',
            'updated' => 'Profile updated successfully',
        ],

        'password-reset' => [
            'sent-email' => 'Verification code has been sent to your email',
            'sent-phone' => 'Verification code has been sent to your phone',
            'verified' => 'Code verified successfully',
            'reset' => 'Password changed successfully',
        ],

        'verification' => [
            'sent-email' => 'Verification code has been sent to your email',
            'sent-phone' => 'Verification code has been sent to your phone',
            'verified' => 'Code verified successfully',
        ],

        'change-authenticable' => [
            'sent-email' => 'Verification code has been sent to your email',
            'sent-phone' => 'Verification code has been sent to your phone',
            'verified' => 'Code verified successfully',
        ],


    ],

    'notifications' => [

        'change-password' => [
            'subject' => 'Password Change',
            'greeting' => 'Dear :user',
            'line' => 'Your password has been changed',
            'password' => 'Your password is :password',
            'footer' => 'Thank you for using our application',
            'salutation' => 'Best regards, :app Team',
        ],

        'reset-password' => [
            'subject' => 'Password Reset',
            'greeting' => 'Dear :user',
            'line' => 'Your verification code is :code',
            'time' => 'Valid for :minutes minutes',
            'footer' => 'Thank you for using our application',
            'salutation' => 'Best regards, :app Team',
        ],

        'verification' => [
            'subject' => 'Verification Code',
            'greeting' => 'Dear :user',
            'line' => 'Your verification code is :code',
            'time' => 'Valid for :minutes minutes',
            'footer' => 'Thank you for using our application!',
            'salutation' => 'Best regards, :app Team',
        ]
    ],
];
