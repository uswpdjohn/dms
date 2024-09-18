<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralDocumentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'service_id'=>'required|integer',
            'name'=>'required',
            'file'=>'sometimes|mimes:pdf,doc,docx,JPG,jpg,png,PNG,bmp,gif,xlsx',
            'current_document_id'=>'sometimes',
            'document_hashed'=>'sometimes',
        ];
    }
    public function messages()
    {
        return [
            'company_id.required' => '* Company is required',
            'name.required' => '* Document Name is required',
//            'shareholder.required' => 'Shareholder is required',
//            'director.required' => 'Director is required',
        ];

    }
}
