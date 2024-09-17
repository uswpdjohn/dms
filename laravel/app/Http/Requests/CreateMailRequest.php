<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMailRequest extends FormRequest
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

    public function messages()
    {
        return [
            'from.required' => 'From is required',
            'from.min' => 'From must be at least 2 characters',
            'from.max' => 'From must not be greater than 255 characters',
            'title.required' => 'Title is required',
            'title.min' => 'Title must be at least 3 characters',
            'company_id.required' => 'Company is required',
            'category.required' => 'Category is required',
            'file.mimes' => 'File type does not match' ,
            'file.max' => 'File size must not be greater than 11Mb',
            'directory.required' => 'Folder Name is required'

        ];

    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'from'=>"required|min:2|max:255",
            'company_id'=>"required",
            'category'=>"required",
            'title'=>"required|min:3",
            'priority'=>"sometimes",
            'file'=>"sometimes|file|mimes:zip,pdf,doc,docx,JPG,jpg,png,PNG,bmp,gif,xlsx|max:11264", //required 11264kb = 11 mb
            'directory'=>"required",
            'short_message'=>"sometimes",
        ];
    }
}
