<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'first_name'=> 'required|min:1',
            'last_name'=> 'sometimes|min:1',
//            'password'=> 'sometimes|confirmed|min:6',
//            'email' => "required|email|unique:users,email,$this->user,slug",
            'email' => "required|email|unique:users,email,$this->user,slug",

//            'email' => [
//                'required',
//                Rule::unique('users')->ignore($this->user),
//            ],
            'designation' => "sometimes",
            'permission'=>'sometimes|array',
            'role'=>'required'
        ];

    }
    public function messages()
    {
        return [
            'first_name.required' => 'First Name is required and must be at least 3 characters',
            'first_name.min' => 'First Name must be more than 3 characters',
//            'last_name.required' => 'Last Name is required and must be at least 3 characters',
//            'last_name.min' => 'Last Name must be more than 3 characters',
            'email.required' => 'Email is required and must be valid',
            'email.email' => 'The Email must be a valid email address',
        ];

    }
}
