<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
//            'name' => 'required|min:3',
//            'uen' => 'required|alpha_num|size:10',
            'fye' => 'required',
            'incorporation_date' => 'required',
            'last_ar_filed' => 'sometimes',
            'last_agm_filed' => 'sometimes',
//            'company_age' => 'required',
//            'gst_reg_no' => 'sometimes',
//            'no_of_employees' => 'required',
//            'no_of_offices' => 'required',
            'primary_industry_service_ssic_id' => 'required',
            'secondary_industry_service_ssic_id' => 'sometimes',
            'address_line' => 'required',
//            'company_image' => 'sometimes',
            'image' => 'sometimes|mimes:jpg,jpeg,png,jfif,svg|max:10240',
//            'status' => 'required',
//            'created_by' => 'required',
//            'director'=> 'sometimes|array',
//            'director.*'=> 'integer',
//            'shareholder'=> 'sometimes|array',
//            'shareholder.*'=> 'integer',
//            'user'=> 'sometimes|array',
//            'user.*'=> 'integer',
        ];
    }

    public function messages()
    {
        return [
//            'name' => 'Company Name is required',
//            'uen' => 'UEN is required',
            'fye.required' => 'FYE is required',
            'incorporation_date.required' => 'Incorporation Date is required',
//            'company_age' => 'Company Age is required',
//            'no_of_employees' => 'no of Employees is required',
//            'no_of_offices' => 'No of Offices is required',
            'primary_industry_service_ssic_id.required' => 'Primary Industry Services is required',
            'address_line.required' => 'Address is required',
//            'status' => 'Status is required',
//            'services' => 'Services is required',
//            'subscription_start' => 'Subscription Start is required',
//            'subscription_period' => 'Subscription Period is required',
        ];

    }
}
