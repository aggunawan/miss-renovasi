<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class InvoiceStatus extends Enum
{
    const Created = 1;
    const Scheduled = 2;
    const Sended = 3;
    const Paid = 4;
    const Resended = 5;
}
