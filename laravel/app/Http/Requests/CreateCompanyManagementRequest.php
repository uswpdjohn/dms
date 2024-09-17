<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyManagementRequest extends FormRequest
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

            "role"=>"sometimes",
            "first_name"=>"required|min:1",
            "last_name"=>"sometimes|min:1",
//            "company_id"=>'required',

//            "email"=>"required|email|unique:company_management,email",
            "email"=>"required|email",
//            "ccs"=>"sometimes|array",
            "ccs"=>"sometimes|array",

            'company_id'=>'required',
            'user_type'=>'sometimes',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required and must be at least 1 characters',
            'first_name.min' => 'First Name must be more than 1 characters',
//            'last_name.required' => 'Last Name is required and must be at least 1 characters',
            'last_name.min' => 'Last Name must be more than 1 characters',
            'email.required' => 'Email is required and must be valid',
            'email.email' => 'The Email must be a valid email address',
        ];

    }
}
