<?php

namespace App\Enums;



enum PaymentsEnum: string
{

    case Wallet = "1";
    case Cash = "2";
    case Myfatorah = "3";


    public static function seeder()
    {
        $data = [
            [
                'id' => self::Wallet->value,
                'name:ar' => 'الدفع من المحفظة',
                'name:en' => 'Pay from wallet',
                'active' => true,
            ],
            [
                'id' => self::Cash->value,
                'name:ar' => 'الدفع عند الاستلام',
                'name:en' => 'Pay on Delivery',
                'active' => true,
            ],
            [
                'id' => self::Myfatorah->value,
                'name:ar' => 'ماي فاتورة',
                'name:en' => 'MyFatorah Payment',
                'active' => true,
            ],
        ];

        return $data;
    }


    public static function translatedName($status)
    {
        return trans("payments::payments.status." . $status);
    }
}
