<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PaymentStatus extends Enum
{
    const Created = 1;
    const Pay = 2;
    const Decline = 3;
    const Approved = 4;

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::Created:
                return 'Belum dibayar';
                break;

            case self::Pay:
                return 'Pembayaran diterima, dalam proses verifikasi';
                break;

            case self::Decline:
                return 'Pembayaran ditolak, kirim kembali bukti pembayaran';
                break;

            case self::Approved:
                return 'Pembayaran terverifikasi';
                break;
            
            default:
                return parent::getDescription($value);
                break;
        }
    }
}
