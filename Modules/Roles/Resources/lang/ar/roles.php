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
        'create' => 'انشاء :module',
        'read' => 'قراءة :module',
        'update' => 'تعديل :module',
        'delete' => 'حذف نهائي :module',
        'show' => 'عرض :module',
        'forceDelete' => 'حذف مؤقت :module',
        'restore' => 'استعاده :module',
        'block' => 'حظر :module',
    ],


    'role_map' => [
        'super_admin' => 'ادمن رئيسي',
        'admin' => 'ادمن',
    ]
];
