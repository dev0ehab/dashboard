<?php

return [
    'singular' => 'Delivery',
    'plural' => 'Deliveries',


    'attributes' => [
        ...trans("accounts::auth.attributes"),
        "zone_id" => 'Zone',
        "shift_id" => 'Shift',
    ]
];
