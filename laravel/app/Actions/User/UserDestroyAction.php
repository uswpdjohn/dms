<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class UserDestroyAction
{
    public function execute($slug)
    {
        DB::beginTransaction();
        try {
            $item = User::where('slug',$slug)->first();

//            ($item->id==auth()->guard('web')->user()->id ? Session::flash('error', 'You are currently logged in') : $item->delete());
            if ($item->id == auth()->guard('web')->user()->id) {
                throw new \Exception('405');
            }elseif ($item->getRoleNames()[0] == 'Super Admin'){
                throw new \Exception('406');
            } else {
                $item->delete();
//                DB::table('company_users')->where('user_id', $item->id)->delete();
//                if (count($company_users)>0){
//                    foreach ($company_users as $company_user){
//                        $company_user->delete();
//                    }
//                }
            }

            DB::commit();
        }catch (\Exception $exception){
//throw new \Exception('error: '.$exception->getMessage());
            DB::rollBack();
            return $exception->getMessage();
        }



    }
}
