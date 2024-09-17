<?php

namespace App\Actions\User;

use App\Actions\ActionClass;
use App\Actions\DocumentManagement\RetrieveLatestFourDocumentAction;
use App\Models\DocumentManagement;
use App\Models\User;
use http\Env\Request;

class UserListAction
{
    public function execute($search,$count,$orderBy,$request){
        $users = User::query();

        if ($request->search == '0'){
            if ($request->designation != 'all'){
                $users = $users->with('roles')->where('designation', $request->designation);
            }
        }
        if(!auth()->guard('web')->user()->hasRole('Super Admin')){
            $id='';
            if(auth()->guard('web')->user()->hasRole('Company Owner')){
                $id=auth()->user()->id;
            }else if (auth()->guard('web')->user()->hasRole('Employee')){
                $id=auth()->user()->created_by;
            }
            return $users->with('roles')->where('created_by', $id)
                ->orderBy('created_at',$orderBy)
                ->paginate($count);
        }

        return $users->with('roles')->orderBy('created_at',$orderBy)->paginate($count);


    }
}
