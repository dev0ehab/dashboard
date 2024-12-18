<?php


 return array_merge(trans("accounts::auth"), [

    'validations' => array_merge(trans("accounts::auth.validations"), [
        'dont_have_role' => 'هذا المسؤول لا يملك صلاحايات',
    ]),

]);
