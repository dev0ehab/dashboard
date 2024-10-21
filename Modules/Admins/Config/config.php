<?php

return [

    /*
     * The module name.
     */
    'name' => 'Admins',

    /*
     * The sms configuration.
     */
    'sms_api_key' => config('services.smsKey.Key'),
    'sms_site' => config('services.smsKey.site'),
    'sms_title' => config('services.smsKey.title'),
];
