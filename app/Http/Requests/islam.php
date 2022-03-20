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
            'email'=> 'required|unique:custmors,email',
            'name'=> 'required|string',
            'company_name'=> 'required',
            'phone' => 'required|max:20',
            'product_id' => 'required|integer|exists:products,id'.request()->segment(3) . ',id',
        ];
    }
}
