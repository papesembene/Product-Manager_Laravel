<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'order_date'=>'required|date',
            'order_num'=>'required|string',
            'customer_id'=>'required',
            'status'=>'required',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.order_quantity' => 'required|integer|min:1',
        ];
    }
}
