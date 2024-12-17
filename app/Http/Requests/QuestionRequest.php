<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuestionRequest extends FormRequest
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

        $rules = [
            'title' => 'required',
            'secondary_title' => 'required',
            'description' => 'required',
            'answer' => 'required_if:answer_type,Images|array|min:2',
            'answer.*' => 'required_if:answer_type,Text',
            'image_description.*' => 'required_if:answer_type,Images|max:40',
            'is_multiple' => 'nullable',
        ];
        return $rules;
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
            'answer.min' => 'Minimum 2 choices are required',
            'answer.*.required' => 'Please enter the answer',
            'image_description.*.required_if' => 'The image description field is required ',
            'image_description.*.max' => 'The image description field must not exceed :max characters.',
        ];
    }
}
