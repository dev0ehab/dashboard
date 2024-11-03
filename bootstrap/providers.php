<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    Modules\Admins\Providers\AdminsServiceProvider::class,
    Modules\Accounts\Providers\AccountsServiceProvider::class,
    Modules\Roles\Providers\RolesServiceProvider::class,
];
