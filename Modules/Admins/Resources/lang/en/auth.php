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
        'verification' => 'This :attribute is invalid.',
        'phone-not-verified' => 'Phone number is not verified.',
        'email-not-verified' => 'Email is not verified.',
    ],
    'attributes' => [
        'code' => 'Verification code',
        'token' => 'Verification token',
        'email' => 'Email',
        'phone' => 'Phone number',
        'username' => 'Email or phone number',
        'password' => 'Password',
    ],
    'messages' => [
        'register' => 'You have registered successfully.',
        'logout' => 'You have logged out successfully.',
        'login' => 'You have logged in successfully.',

        'profile' => [
            'change-password' => 'Password has been changed successfully.',
            'preferred-locale' => 'Language has been changed successfully.',
            'updated' => 'Profile updated successfully.',
        ],

        'password-reset' => [
            'sent-email' => 'A verification code has been sent to your email.',
            'sent-phone' => 'A verification code has been sent to your phone number.',
            'verified' => 'Code verified successfully.',
            'reset' => 'Password has been changed successfully.',
        ],

        'verification' => [
            'sent-email' => 'A verification code has been sent to your email.',
            'sent-phone' => 'A verification code has been sent to your phone number.',
            'verified' => 'Code verified successfully.',
        ],

    ],
    'emails' => [
        'forget-password' => [
            'subject' => 'Verification Code for Login',
            'greeting' => 'Dear :user',
            'line' => 'Your verification code is :code',
            'time' => 'Valid for :minutes minutes.',
            'footer' => 'Thank you for using our application.',
            'salutation' => 'Best regards, :app team.',
        ],
        'reset-password' => [
            'subject' => 'Password Reset',
            'greeting' => 'Dear :user',
            'line' => 'Your password has been changed.',
            'footer' => 'Thank you for using our application.',
            'salutation' => 'Best regards, :app team.',
        ],
    ],

    'register' => [
        'verification' => [
            'subject' => 'Verification Code',
            'greeting' => 'Dear :user',
            'line' => 'Your verification code for :app is :code',
            'footer' => 'Thank you for using our application!',
            'salutation' => 'Best regards, :app team.',
        ]
    ],

    'verification' => [
        'invalid' => 'The code you entered is incorrect.',
        'sent' => 'The activation code has been sent successfully.',
        'verified' => 'Your phone is verified.',
        'attributes' => [
            'user_id' => 'User',
            'phone' => 'Phone',
            'code' => 'Activation code',
        ],
    ],

];
