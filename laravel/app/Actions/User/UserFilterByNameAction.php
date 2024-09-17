<?php

namespace App\Actions\User;

use App\Models\User;

class UserFilterByNameAction
{
    public function execute($orderBy,$count)
    {
        if(!auth()->guard('web')->user()->hasRole('Super Admin')){
            return User::with('roles')->where('created_by', auth()->user()->id)
                ->orderBy('created_at',$orderBy)
                ->paginate($count);
        }
        $company=User::with('roles')->orderBy('first_name', $orderBy)->paginate($count);
        return $company;
    }
}
