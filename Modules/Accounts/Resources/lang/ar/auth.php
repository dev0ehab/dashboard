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
        'failed' => 'بيانات الاعتماد هذه غير متطابقة مع البيانات المسجلة لدينا.',
        'deleted' => 'تم حذف هذا الحساب.',
        'blocked' => 'تم حظر هذا الحساب.',
        'password' => 'كلمة المرور التي ادخلتها غير صحيحة!',
        'throttle' => 'عدد كبير جدا من محاولات الدخول. يرجى المحاولة مرة أخرى بعد :seconds ثانية.',
        'verification' => 'هذا :attribute غير صالح',
        'phone-not-verified' => 'رقم الهاتف غير مفعل',
        'email-not-verified' => 'البريد الالكتروني غير مفعل',
    ],
    'attributes' => [
        'code' => 'رمز التحقق',
        'token' => 'شفرة التحقق',
        'email' => 'البريد الالكتروني',
        'phone' => 'رقم الهاتف',
        'username' => 'البريد الالكترونى او رقم الهاتف',
        'password' => 'كلمة المرور',
    ],
    'messages' => [
        'register' => 'تم تسجيلك بنجاح',
        'logout' => 'تم تسجيل الخروج بنجاح',
        'login' => 'تم تسجيل الدخول بنجاح',

        'profile' => [
            'change-password' => 'تم تغيير كلمة المرور بنجاح',
            'preferred-locale' => 'تم تغيير اللغة بنجاح',
            'updated' => 'تم تحديث البيانات بنجاح',
        ],

        'password-reset' => [
            'sent-email' => 'تم ارسال رمز التحقق على بريدك الالكتروني',
            'sent-phone' => 'تم ارسال رمز التحقق على رقم هاتفك',
            'verified' => 'تم التحقق من الرمز بنجاح',
            'reset' => 'تم تغيير كلمة المرور بنجاح',
        ],

        'verification' => [
            'sent-email' => 'تم ارسال رمز التحقق على بريدك الالكتروني',
            'sent-phone' => 'تم ارسال رمز التحقق على رقم هاتفك',
            'verified' => 'تم التحقق من الرمز بنجاح',
        ],

    ],

    'notifications' => [

        'change-password' => [
            'subject' => 'تغيير كلمة المرور',
            'greeting' => 'عزيزي :user',
            'line' => 'تم تغيير كلمة المرور الخاصة بك',
            'password' => ":password كلمة المرور الخاصة بك",
            'footer' => 'شكراً لاستخدامك لتطبيقنا',
            'salutation' => 'مع تحيات فريق عمل :app',
        ],

        'reset-password' => [
            'subject' => 'استعادة كلمة المرور',
            'greeting' => 'عزيزي :user',
            'line' => ":code  رمز التحقق الخاص بك",
            'time' => " صالح لمدة :minutes دقائق",
            'footer' => 'شكراً لاستخدامك لتطبيقنا',
            'salutation' => 'مع تحيات فريق عمل :app',
        ],

        'verification' => [
            'subject' => 'رمز التحقق',
            'greeting' => 'عزيزي :user',
            'line' => 'رمز التحقق الخاص بك هو :code',
            'time' => " صالح لمدة :minutes دقائق",
            'footer' => 'شكرا لك على استخدام تطبيقنا!',
            'salutation' => 'مع تحيات فريق عمل, :app',
        ]
    ],
];
