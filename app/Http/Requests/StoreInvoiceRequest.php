<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|min:1|max:255',
            'year' => 'required|integer|min:1390',
            'month' => 'required|integer|min:1|max:12',
            'description' => 'nullable|string|min:1|max:500',
            'is_cash' => 'required|boolean',
        ];
    }
}
