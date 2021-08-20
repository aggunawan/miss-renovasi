<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $casts = [
        'confirmed_at' => 'datetime'
    ];

    protected $fillable = [
        'user_id',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus()
    {
        return PaymentStatus::fromValue($this->status)->description;
    }

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function isConfirmable()
    {
        return collect([
            PaymentStatus::Created,
            PaymentStatus::Decline,
        ])->contains($this->status);
    }

    public function isVerifyable()
    {
        return collect([PaymentStatus::Pay])->contains($this->status);
    }

    public function isReceiptDownloadable()
    {
        $approved = collect([PaymentStatus::Approved])->contains($this->status);

        return $approved and $this->receipt()->exists();
    }

    public function receipt()
    {
        return $this->hasOne(PaymentReceipt::class);
    }

    public function getCustomerName()
    {
        return $this->invoice->customer->name;
    }
}
