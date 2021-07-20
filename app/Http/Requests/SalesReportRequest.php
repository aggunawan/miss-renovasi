<?php

namespace App\Http\Requests;

use App\Enums\ReportType;
use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SalesReportRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        return [
            'label' => 'required|min:5|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'type' => [
                'required',
                Rule::in([ReportType::Monthly, ReportType::Customer])
            ]
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
