<?php

namespace App\Enums;


enum NotificationTypesEnum: string
{
    case General = 'general';



    public static function NotificationUrl($type, $id)
    {
        return match ($type) {
            self::General->value => ''
        };
    }
}
