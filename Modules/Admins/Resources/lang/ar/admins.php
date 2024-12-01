<?php

return [
    'singular' => 'مسؤول',
    'plural' => 'مسؤولين',
    'attributes' => [
        ...trans("accounts::auth.attributes"),
        'branch_id' => 'الفرع',
        'permitted_branches' => 'الفروع المسموح بها',
    ]
];
