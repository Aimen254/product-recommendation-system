<?php

namespace App\Http\Requests;

use App\Models\ProductSetup;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
        if (strip_tags(request()->product_description) == "") {
            throw new HttpResponseException(
                response()->json(['success' => false, 'message' => 'The Product description field is required'], 400)
            );
        }
        $inputNames = request()->keys();
        $productSetup = ProductSetup::whereIn('field', $inputNames)->get();
        $rules = [
            'product_title' => 'required|max:1000',
            'product_description' => 'max:10000',
            'product_url' => 'required|url',
        ];
        return $rules;
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['success' => false, 'message' => $validator->errors()->first()], 400)
        );
    }
}
