<?php


return [

    'singular' => 'تواصل معنا',
    'plural' => 'تواصل معنا',
    'attributes' => [
        'name' => 'اسم المستخدم',
        'email' => 'البريد الإلكتروني',
        'phone' => 'رقم الهاتف',
        'dial_code' => ' كود الدولة',
        'message' => 'الرسالة',
    ],

    'permission_map' => [
        'create' => 'انشاء :module',
        'read' => 'قراءة :module',
        'update' => 'تعديل :module',
        'delete' => 'حذف نهائي :module',
        'show' => 'عرض :module',
        'forceDelete' => 'حذف مؤقت :module',
        'restore' => 'استعاده :module',
        'block' => 'حظر :module',
    ],


    'contactus_map' => [
        'super_admin' => 'ادمن رئيسي',
        'admin' => 'ادمن',
    ]
];
