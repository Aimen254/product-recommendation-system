<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'category_title'=>'required',
            'category_secondary_title'=>'required',
            'category_description' => 'nullable',
            'products' =>  'array|min:1|required',
            'products.*' => 'required',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['success' => false, 'message' => $validator->errors()->first()], 400)
        );
    }

    public function messages()
    {
        return [
            'products.min' => 'Minimum 1 product is required',
            'products.*.required' => 'Please select product'
        ];
    }
}
