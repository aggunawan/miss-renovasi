<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        return [
            'number' => 'required',
            'contract_number' => 'required',
            'date' => 'required|date|before_or_equal:due',
            'due' => 'required|date|after_or_equal:date',
            'customer_id' => 'required|numeric|exists:customers,id',
            'bank_account_id' => 'required|numeric|exists:bank_accounts,id',
            'contents' => 'required|json',
        ];
    }

    public function attributes()
    {
        return [
            //
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
