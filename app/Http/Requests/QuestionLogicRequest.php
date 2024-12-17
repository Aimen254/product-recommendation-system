<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class QuestionLogicRequest extends FormRequest
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
            // 'answer' => 'array|required',
            // 'answer.*' => 'required',
            // 'question' => 'array|required',
            // 'question.*' => 'required',
            'details.*.logic' => 'required',
            'details.*.question' => 'required',
            'details.*.value' => 'required',

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
            // 'question.min' => 'Minimum 1 question condition is required',
            'question.*.required' => 'Please select next question',
            // 'answer.min' => 'Minimum 1 answer condition is required',
            'answer.*.required' => 'Please select an answer',
        ];
    }
}
