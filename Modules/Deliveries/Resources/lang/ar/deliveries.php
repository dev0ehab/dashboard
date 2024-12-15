<?php

return [
    'singular' => 'السائق',
    'plural' => 'السائقين',

    'attributes' => [
        ...trans("accounts::auth.attributes"),
        "zone_id" => 'منطقة التوصيل',
        "shift_id" => 'موعد العمل',
    ]
];
