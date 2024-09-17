<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadDocumentRequest extends FormRequest
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
            'file'=>'required|mimes:pdf,doc,docx,JPG,jpg,png,PNG,bmp,gif,xlsx',
            'shareholder' => 'sometimes|array|required_if:reminder_date,null|required_if:recipient_name,null',
//            'shareholder.*' => 'int',
            'director' => 'sometimes|array|required_if:reminder_date,null|required_if:recipient_name,null',
//            'director.*' => 'int',
            'current_document_id'=>'sometimes',
            'document_hashed'=>'sometimes',
            'reminder_date'=>'sometimes|date|required_without:shareholder|required_without:director',
            'recipient_name'=>'sometimes|string|min:3|required_without:shareholder|required_without:director',
        ];
    }
    public function messages()
    {
        return [
            'company_id.required' => 'Company is required',
            'name.required' => 'Document Name is required',
            'file.required' => 'File is required',
//            'shareholder.required' => 'Shareholder is required',
//            'director.required' => 'Director is required',
        ];

    }
}
