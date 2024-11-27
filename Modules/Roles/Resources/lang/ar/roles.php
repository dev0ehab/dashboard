<?php


return [

    'singular' => 'دور',
    'plural' => 'ادوار',
    'attributes' => [
        'name' => 'اسم الدور',
        'display_name:en' => 'اسم الدور باللغة الانجليزية',
        'display_name:ar' => 'اسم الدور باللغة العربية',
        'permissions' => 'الصلاحيات',
    ],

    'permission_map' => [
        'index' => 'قراءة :module',
        'show' => 'عرض :module',
        'store' => 'انشاء :module',
        'update' => 'تعديل :module',
        'destroy' => 'حذف نهائي :module',
        'forceDelete' => 'حذف مؤقت :module',
        'restore' => 'استعاده :module',
        'block' => 'حظر :module',
        'unblock' => 'الغاء حظر :module',
    ],


    'role_map' => [
        'super_admin' => 'ادمن رئيسي',
        'admin' => 'ادمن',
    ]
];
