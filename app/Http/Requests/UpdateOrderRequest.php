<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'branch_id' => 'sometimes|exists:branches,id',
            'items' => 'sometimes|array',
            'items.*.product_id' => 'sometimes|exists:products,id',
            'items.*.quantity' => 'sometimes|integer|min:1',
            'items.*.price' => 'sometimes|numeric|min:0',
        ];
    }
}
