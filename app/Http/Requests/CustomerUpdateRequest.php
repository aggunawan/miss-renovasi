<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        return [
            'name' => 'required|min:5|max:255',
            'address' => 'required|min:5|max:255',
            'email' => 'required|min:5|max:255|unique:customers,email,' . request()->get('id'),
            'phone' => ['nullable', 'numeric', 'regex:/\+?([ -]?\d+)+|\(\d+\)([ -]\d+)/'],
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
