<?php

namespace App\Actions\User;

use App\Models\User;

class UserFilterByDesignationAction
{
    public function execute($designation,$count,$orderBy)
    {
        $users = User::query();
        if ($designation == 'all'){
            if(!auth()->guard('web')->user()->hasRole('Super Admin')){
                return $users->with('roles')->where('created_by', auth()->user()->id)
                    ->orderBy('created_at',$orderBy)
                    ->paginate($count);
            }
            $users = $users->with('roles')->orderBy('created_at',$orderBy)->paginate($count);
            return $users;
        }
        if(!auth()->guard('web')->user()->hasRole('Super Admin')){
            return $users->with('roles')->where('designation', $designation)->where('created_by', auth()->user()->id)
                ->orderBy('created_at',$orderBy)
                ->paginate($count);
        }

        $users = $users->with('roles')->where('designation', $designation)->orderBy('created_at',$orderBy)->paginate($count);
        return $users;
    }

}
