<?php

namespace App\Helpers;

use App\Models\CompanyMember;

class EsopCompanyHelper
{
    public static function set($companyID)
    {
        session()->forget('esopCompanyId');
        session()->put('esopCompanyId', $companyID);
    }

    public static function get()
    {
        return auth()->guard('web')->user()->hasRole('Admin') || auth()->guard('web')->user()->hasRole('Super Admin') ? session()->get('esopCompanyId') : session()->get('auth_user_company')->id;
    }

    public static function getESOPReserveData()
    {
        return CompanyMember::where('name', 'ESOP Reserve')->where('company_id', EsopCompanyHelper::get())->first();
    }

}
