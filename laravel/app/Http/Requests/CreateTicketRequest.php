<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
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
            'message' => 'required|min:5',
            'file' => 'sometimes|mimes:pdf,doc,docx,JPG,jpg,png,PNG,bmp,gif,xlsx|max:10240',
            "category_id"=>"required|integer",
        ];
    }
    public function messages()
    {
        return [
            'message.required' => 'Message is required and must be more than 5 characters',
            'category_id.required' => 'Category is required',
            'category_id.integer' => 'Category is required'
        ];

    }
}
