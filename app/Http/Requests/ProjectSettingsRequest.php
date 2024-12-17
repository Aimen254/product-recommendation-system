<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProjectSettingsRequest extends FormRequest
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
        $icon = request('home_icon');

        if($icon && $icon->extension() == 'svg'){
            return [
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                'home_icon' => 'image|mimes:jpeg,png,jpg,svg',
            ];
        }
        else{
            return [
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                'home_icon' => 'image|mimes:jpeg,png,jpg,svg | dimensions:max_width=20,max_height=20',
            ];
        }
       
    }
    public function messages(){
        return [
            'home_icon.dimensions' => 'Image width and height must be 20px',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(['success' => false, 'message' => $validator->errors()->first()], 400)
        );
    }
}
