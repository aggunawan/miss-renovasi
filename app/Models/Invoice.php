<?php

namespace App\Models;

use App\Enums\InvoiceStatus;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'number',
        'contract_number',
        'date',
        'due',
        'customer_id',
        'bank_account_id',
        'contents',
    ];

    protected $casts = [
        'contents' => 'array',
        'date' => 'datetime',
        'due' => 'datetime',
    ];

    public function getDescriptiveStatus()
    {
        switch ($this->status) {
            case InvoiceStatus::Created:
                return 'Dibuat';
                break;
            
            default:
                return 'Tidak Diketahui';
                break;
        }
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
