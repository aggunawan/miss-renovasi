<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Role extends Enum
{
    const Administrator = 1;
    const Manager = 2;

    public static function getDescription($value): string
    {
        if ($value === self::Manager) {
            return 'Direktur';
        }

        return parent::getDescription($value);
    }
}
