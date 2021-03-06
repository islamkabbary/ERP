<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class islam extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'phone' => ['required'|'max:20',Rule::unique('customers', 'phone')->ignore($this->phone)],
            'customer_id' => 'required_if:type,installment|exists:customers,id',
            'email'=> 'required|unique:custmors,email|mimes:png,jpg|numeric',
            'email'=> 'required_if:type,installment',
            'name'=> 'required|string',
            'company_name'=> 'required',
            'phone' => 'required|max:20',
            'product_id' => 'required|integer|exists:products,id'.request()->segment(3) . ',id|in:installment,cash',
        ];
    }
}
