<?php

namespace App\Actions\User;

use App\Models\User;

class UserSearchAction
{
    public function execute($search,$count,$orderBy,$request)
    {
        $users = User::query();
        if ($request->designation!='all'){
            if(!auth()->guard('web')->user()->hasRole('Super Admin')){
                $users= $users->with('roles')->where('created_by', auth()->user()->id)
                    ->where('designation', $request->designation)
                    ->where('email', 'LIKE', "%$search%")
                    ->orderBy('created_at',$orderBy)->paginate($count);
            }else{
                $users = $users->with('roles')->where('designation', $request->designation)
                    ->where('email', 'LIKE', "%$search%")
                    ->orderBy('created_at',$orderBy)->paginate($count);
            }

        }else{
            if(!auth()->guard('web')->user()->hasRole('Super Admin')){
                $users = $users->with('roles')->where('created_by', auth()->user()->id)
//                    ->where('first_name', 'LIKE', "%$search%")
//                    ->orWhere('last_name', 'LIKE', "%$search%")
//                    ->orWhere('designation', 'LIKE', "%$search%")
                    ->where('email', 'LIKE', "%$search%")
                    ->orderBy('created_at',$orderBy)->paginate($count);
            }else{
                $users = $users->with('roles')
//                    ->where('first_name', 'LIKE', "%$search%")
//                    ->orWhere('last_name', 'LIKE', "%$search%")
//                    ->orWhere('designation', 'LIKE', "%$search%")
                    ->where('email', 'LIKE', "%$search%")->orderBy('created_at',$orderBy)->paginate($count);
            }

        }
        return  $users;
    }

}
