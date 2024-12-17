<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AdviceLogicRequest extends FormRequest
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
            'advice' => ['required', $this->advice_logic ? Rule::unique('advice_logics', 'advice_id')->where('project_id', getActiveProject()['id'])->ignore($this->advice_logic->id) : Rule::unique('advice_logics', 'advice_id')->where('project_id', getActiveProject()['id'])],
            'question' => 'array|min:1|required',
            'question.*' => 'required',


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
            'question.min' => 'Minimum 1 question condition is required',
            'question.*.required' => 'Please select a question',
            'advice.unique' => 'Condition for this advice already exits'
        ];
    }
}
