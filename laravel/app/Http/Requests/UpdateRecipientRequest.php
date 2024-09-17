<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipientRequest extends FormRequest
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
            'first_name'=>'required|min:1',
            'last_name'=>'required|min:1',
            'email'=>'required|email',
            'category_id'=>'required|int',
        ];
    }
    public function messages()
    {
        return [
            'first_name.required'=>'First Name is required',
            'first_name.min'=>'First Name must be at least 1 characters',
            'last_name.required'=>'Last Name is required',
            'last_name.min'=>'Last Name must be at least 1 characters',
            'email.required'=>'Email is required',
            'email.email'=>'Email must be a valid email',
        ];
    }
}
