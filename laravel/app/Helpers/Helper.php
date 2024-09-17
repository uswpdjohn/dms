<?php

namespace App\Helpers;

use App\Models\Company;
use App\Models\CompanyUserSession;
use App\Models\Invoice;
use App\Models\Permission;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\User;
use App\Models\XeroAuthCredential;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

//use Yajra\DataTables\DataTables;

class Helper
{

    static function date_format($date = null, $type = 'HUMAN', $format = 'Y-m-d')
    {
        switch ($type) {
            case 'HUMAN':
                return date("F jS, Y", strtotime($date ? $date : date('m/d/Y h:i:s a', time())));
            case "CURRENT_YEAR":
                return date("Y");
            default:

        }

    }
    static public function auth_user_company(){
        $selected_company = CompanyUserSession::where('key', 'company_id')->first();
        return $selected_company->value;
    }

    static public function checkedTitle($array, $value)
    {
        if (!$array) return '';
        foreach ($array as $item) {
            echo $item['title'] === $value ? 'checked' : '';

        }

    }

    static public function determinePageHeading()
    {
        $url= URL::current();

        $url_for=explode('/',$url);
//                dd( $url_for);
        if ($url_for[3] == 'dashboard'){
            return ['heading' => 'Dashboard'];
        }elseif ($url_for[3] == 'company'){
            return ['heading' => 'Company Management'];
        }elseif ($url_for[3] == 'mail'){
            return ['heading' => 'Mailbox'];
        }elseif ($url_for[3] == 'user'){
            return ['heading' => 'User Management'];
        }elseif ($url_for[3] == 'support-ticket'){
            return ['heading' => 'Support Ticket'];
        }elseif ($url_for[3] == 'ticket'){
            return ['heading' => 'Support Ticket'];
        }elseif ($url_for[3] == 'notification'){
            return ['heading' => 'Notification'];
        }else{
            return ['heading' => ''];
        }

    }
    static public function convertToTitleCase($string){
        // Replace underscores with spaces
        $string = str_replace('_', ' ', $string);
        // Capitalize the first letter of each word
        $string = ucwords($string);
        return $string;
    }
    //admin
    static function checkIfXeroIsExpiring(): array
    {
        $message = '';
        $diff = 0;
        $xero_cred = XeroAuthCredential::first();
        if ($xero_cred!=null){
            $expiry_date = Carbon::parse($xero_cred->updated_at)->addDays(60)->toDateString();
            if (now()->toDateString() <= $expiry_date){
                $diff = Carbon::parse(now())->diffInDays($expiry_date);
                if($diff <= 45){
                    $message = 'Xero is Expiring Soon';
                    if ($diff <= 0){
                        $message = 'Xero is Expired';
                    }
                }
            }else{
                $message = 'Xero is Expired';
            }
        }
        return array('message' => $message, 'days to expire' => $diff);

    }

    //customer
    static function subscriptionAlert(){
        $invoices = Invoice::with('company')
            ->where('company_id',\session()->get('auth_user_company')->id ?? '')
            ->whereIn('status', ['overdue', 'invoiced'])
            ->get();

        $message='';

        if(count($invoices)>0){
//            $numberOfDaysToAlert=7;
            $overDueDayAlert=30;
            $subscriptionEndedDayAlert=90;
            foreach ($invoices as $invoice){
                $due_date = Carbon::parse($invoice->due_date);
                $now = Carbon::now()->toDateString();
                $diffInDays = $due_date->diffInDays($now);
                if ($diffInDays <= $overDueDayAlert){

                    $message='Subscription Expiring Soon';

//                    if ($now>$due_date->addDays($subscriptionEndedDayAlert)->toDateString()){
////                        $message='Subscription Expired';
//                        return ['message'=>'Subscription Ended. Pending payment'];
//                    }

//                    return ['message'=>'Subscription Expiring Soon'];

                }else if($now > $due_date->addDays($subscriptionEndedDayAlert)->toDateString()){

//                    if ($now>$due_date->addDays($subscriptionEndedDayAlert)->toDateString()){
//                        $message='Subscription Ended. Pending payment';
                        return ['message'=>'Subscription Ended. Pending payment'];
//                    }
                }
//                dd($message);
            }
            return ['message'=>$message];

        }
    }
    //customer
    static function agmAlert(){
        $company = Company::where('id',\session()->get('auth_user_company')->id ?? '' )->first();
        if ($company->last_agm_filed != null){
            $agm_date = Carbon::parse($company->last_agm_filed)->addYear();
            $now = Carbon::parse(now());
            $interval=$now->diffInDays($agm_date);
            if ($interval <= 30 && $interval >= 0){
                return ['agm_alert_message' => $interval . ' days remaining for AGM'];
            }

        }
//        $startDateString = Carbon::parse(now())->format('m/d');
//        $endDateString = Carbon::parse($company->fye)->format('m/d');
//
//        // Get the current year
//        $currentYear = date('Y');
//
//        // Construct full date strings with the current year
//        $startDateFull = "$startDateString/$currentYear";
//        $endDateFull = "$endDateString/$currentYear";
//        $startDate = Carbon::createFromFormat('m/d/Y', $startDateFull)->format('Y-m-d');
//        $endDate = Carbon::createFromFormat('m/d/Y', $endDateFull)->timezone('Asia/Dhaka')->format('Y-m-d');
//        $startDateParsed = Carbon::parse($startDate);
//        $endDateParsed = Carbon::parse($endDate);
//
//        $interval = $startDateParsed->diff($endDateParsed);
//        $interval=$interval->days - 1; // subtract 1 cause interval returns +1d


    }

//    static public function expiringSoonAlertMessage(){
//        dd('Subscription Expiring Soon');
//        return ['message' => 'Subscription Expiring Soon'];
//    }
//    static public function expiredAlertMessage(){
//        dd('Subscription Expired');
//        return ['message' => 'Subscription Expired'];
//    }

//    static public function profile()
//    {
//        $profile = Profile::where('user_id', auth()->user()->id ?? '')->first();
//        if ($profile != null) {
//            return [
//                'name' => $profile->full_name,
//                'image' => $profile->image,
//            ];
//        }
//    }

//    static public function showProfile()
//    {
//        $user = User::where('id', auth()->user()->id ?? '')->first();
//        $data = Profile::where('user_id', $user->id ?? '')->first();
//        return [
//            'uuid' => $data->uuid ?? ''
//        ];
//    }

//    static public function userRolePermission()
//    {
//        $user = \auth()->user()->id ?? '';
//        $data = DB::select("SELECT pr.role_id, pr.permission_id,ru.user_id, ru.role_id AS role_id FROM permission_assign_to_roles AS pr
//                                    INNER JOIN role_assign_to_user AS ru
//                                    ON pr.role_id = ru.role_id
//                                    WHERE ru.user_id = '{$user}'");
//
//        return [
//            'userPermission' => $data ?? ''
//        ];
//    }

//    static public function logo(){
//        $settings = Setting::where('id',1)->first();
//        if ($settings != null){
//            return[
//                'logo' => $settings->logo,
//            ];
//        }
//    }
//    static public function favicon(){
//        $settings = Setting::where('id',1)->first();
//        if ($settings != null){
//            return[
//                'favicon' => $settings->favicon,
//            ];
//        }
//    }
//        static public function permission()
//    {
//        $permission = Permission::all();
//        return [
//            'permission' => $permission ?? ''
//        ];
//    }


}
