<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'invoice_id' => 'required|integer|exists:invoices,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ];
    }
}
