<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentReceipt extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'note',
        'user_id',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getInvoiceNumber()
    {
        return $this->payment->invoice->number;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
