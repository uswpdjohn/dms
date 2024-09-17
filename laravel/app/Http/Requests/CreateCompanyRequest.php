<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
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
            'name.required' => 'Company Name is required',
            'uen.required' => 'UEN is required',
            'uen.min' => 'Min 9 characters is required',
            'uen.max' => 'Max 10 characters is allowed',
            'fye.required' => 'FYE is required',
            'incorporation_date.required' => 'Incorporation Date is required',
            'company_age' => 'Company Age is required',
            'no_of_employees' => 'no of Employees is required',
            'no_of_offices' => 'No of Offices is required',
            'primary_industry_service_ssic_id.required' => 'Primary Industry Services is required',
            'secondary_industry_service_ssic_id' => 'Secondary Industry Services is required',
            'address_line.required' => 'Address is required',
            'status' => 'Status is required',
            'services' => 'Services is required',
            'subscription_start' => 'Subscription Start is required',
            'subscription_period' => 'Subscription Period is required',
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
            'name' => 'required|min:3',
            'uen' => 'required|alpha_num|min:9|max:10',
            'fye' => 'required',
            'last_ar_filed' => 'sometimes',
            'last_agm_filed' => 'sometimes',
            'incorporation_date' => 'required',
//            'company_age' => 'required',
            'gst_reg_no' => 'sometimes',
//            'no_of_employees' => 'required',
//            'no_of_offices' => 'required',
            'primary_industry_service_ssic_id' => 'required',
            'secondary_industry_service_ssic_id' => 'sometimes',
            'address_line' => 'required',
//            'status' => 'required',
//            'created_by' => 'required',
//            'services' => 'required',
//            'subscription_start' => 'required',
//            'subscription_period' => 'required',
        ];
    }
}
