<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralDocumentUploadRequest extends FormRequest
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
            'file'=>'required|mimes:pdf,doc,docx,JPG,jpg,png,PNG,bmp,gif,xlsx',
            'current_document_id'=>'sometimes',
            'document_hashed'=>'sometimes',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Document Name is required',
            'file.required' => 'File is required',
        ];

    }
}
