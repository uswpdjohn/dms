<?php

namespace App\Helpers;

class CapTableCompanyHelper
{
    public static function set($companyID)
    {

        session()->forget('capTableCompanyId');
        session()->put('capTableCompanyId', $companyID);
    }

    public static function get()
    {
        return auth()->guard('web')->user()->hasRole('Admin') || auth()->guard('web')->user()->hasRole('Super Admin') ? session()->get('capTableCompanyId') : session()->get('auth_user_company')->id;
    }

}
