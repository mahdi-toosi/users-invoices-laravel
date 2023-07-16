<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|min:1|max:255',
            'year' => 'required|integer|min:1390',
            'is_cash' => 'required|boolean',
            'month' => 'required|integer|min:1|max:12',
            'description' => 'nullable|string|min:1|max:500',
        ];
    }
}
