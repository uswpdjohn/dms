<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFAQRequest extends FormRequest
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
            'category_id' => 'required|integer',
            'question' => 'required|string|min:3',
            'answer' => 'required|string|min:2',
        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'Category is required',
            'question.required' => 'Question is required',
            'answer.required' => 'Answer is required',
        ];
    }
}
