<?php

namespace App\Http\Controllers;

use App\Models\Setup;
use Illuminate\Http\Request;

class BusinessSettingController extends Controller
{
    public function privacyPolicy()
    {
        $login_bg_image = Setup::where('key', 'login_bg_image')->first();
        $privacy_policy = Setup::where('key', 'privacy_policy')->first();
        return view('businessSettings.privacyPolicy', ['privacy_policy'=>$privacy_policy, 'login_bg_image'=>$login_bg_image['value']]);
    }
    public function termsOfUse()
    {
        $login_bg_image = Setup::where('key', 'login_bg_image')->first();
        $terms_of_use = Setup::where('key', 'terms_of_use')->first();
        return view('businessSettings.terms',['terms_of_use'=>$terms_of_use,'login_bg_image'=>$login_bg_image['value']]);
    }
}
