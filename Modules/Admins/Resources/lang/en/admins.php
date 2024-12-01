<?php

return [
'singular' => 'Admin',
'plural' => 'Admins',
'attributes' => [
    ...trans("accounts::auth.attributes"),
    'branch_id' => 'Branch',
    'permitted_branches' => 'Permitted Branches',
]
];
