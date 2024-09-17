<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSetupRequest extends FormRequest
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
            'login_bg_image'=>'sometimes|image',
            'terms_of_use'=>'sometimes',
            'privacy_policy'=>'sometimes',
        ];
    }
    public function messages()
    {
        return [
            'login_bg_image.image'=>'Content must be type of image',
        ];
    }
}
