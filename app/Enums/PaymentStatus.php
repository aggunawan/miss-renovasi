<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PaymentStatus extends Enum
{
    const Created = 1;

    public static function getDescription($value): string
    {
        if ($value === self::Created) {
            return 'Belum dibayar';
        }

        return parent::getDescription($value);
    }
}
