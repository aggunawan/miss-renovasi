<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentConfirmationUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->guest();
    }

    public function rules()
    {
        return [
            'payment.proof' => 'required|file|max:2048|mimes:jpg,bmp,png'
        ];
    }
}
