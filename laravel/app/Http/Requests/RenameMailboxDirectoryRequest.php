<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RenameMailboxDirectoryRequest extends FormRequest
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
            'directory'=> 'required',
            'prev_directory'=> 'required',
            'company_root_directory'=> 'required',
            'company_category_directory'=> 'required',

        ];
    }
    public function messages()
    {
       return [
         'directory.required' => 'Directory Name is required'
       ];
    }
}
