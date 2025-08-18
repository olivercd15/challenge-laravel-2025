<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_name' => 'required|string|max:255',
            'items'       => 'required|array|min:1',
            'items.*.description' => 'required|string|max:255',
            'items.*.quantity'    => 'required|integer|min:1',
            'items.*.unit_price'  => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'client_name.required' => 'Client name is required.',
            'items.required'       => 'Order must have almost 1 item.',
            'items.*.description.required' => 'Description item is required.',
            'items.*.quantity.min' => 'Quantity is required.',
            'items.*.unit_price.min' => 'Price must be greater than 0.',
        ];
    }
}
