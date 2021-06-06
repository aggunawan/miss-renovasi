<?php

namespace App\Models;

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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
}
