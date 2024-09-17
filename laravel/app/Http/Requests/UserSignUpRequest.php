<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSignUpRequest extends FormRequest
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
            'registered_as' => 'required',
            'first_name'=>'required|min:1',
            'last_name'=>'required|min:1',
            'email'=>'required|email',

        ];
    }

    public function messages()
    {
        return[
            'registered_as.required' => 'Please Select an option',
            'first_name.required' => 'First Name is required and must be at least 1 character long',
            'first_name.min' => 'First Name must be at least 1 character long',
            'last_name.required' => 'Last Name is required and must be at least 1 character long',
            'last_name.min' => 'Last Name must be at least 1 character long',
            'email.required' => 'E-mail id required',
            'email.email' => 'E-mail must be a valid email',
        ];

    }
}
