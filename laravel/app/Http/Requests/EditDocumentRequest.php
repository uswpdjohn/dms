<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDocumentRequest extends FormRequest
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
            'company_id'=>'required|integer',
            'service_id'=>'required|integer',
            'name'=>'required',
            'file'=>'sometimes|mimes:pdf,doc,docx,JPG,jpg,png,PNG,bmp,gif,xlsx',
            'shareholder' => 'sometimes|array',
            'director' => 'sometimes|array',
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
