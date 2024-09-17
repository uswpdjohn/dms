<?php

namespace App\Actions\User;

use App\Models\User;

class UserBulkDeleteAction
{
    public function execute($user_ids)
    {
//        dd($user_ids);

        foreach ($user_ids as $user_id){
            $user = User::with('roles')->where('id',$user_id)->first();
//            dd($users->roles[0]->name);
            if($user->roles[0]->name == 'Super Admin'){
                return redirect()->route('user.index')->with('error', 'Super Admin cannot be deleted');
//                abort(403,'Super Admin cannot be deleted');
//                throw new \Exception('Super Admin cannot be deleted');
            }elseif (auth()->guard('web')->user()->id == $user_id){
                return redirect()->route('user.index')->with('error', 'Logged in user cannot be deleted');
            }
            $user->delete();
//            return $users;
//            dd($user);
        }
//        foreach ($users as $user){
//            $user->delete();
//        }
    }

}
