<?php

namespace App\Actions\DocumentManagement;

use App\Models\Company;
use App\Models\DocumentManagement;
use App\Models\User;


class GetDocumentListAction
{
    public function execute($service_id,$count,$orderBy)
    {
        if(auth()->guard('web')->user()->hasRole('Company Owner')) {
            $company_ids = Company::where('created_by', auth()->user()->id)->pluck('id');
            $document = DocumentManagement::whereIn('company_id',$company_ids)->with('companies')->whereHas('companies')
                ->where('service_id',$service_id)
                ->orderBy('created_at', $orderBy)
                ->paginate($count);
            return $document;
        }elseif (auth()->guard('web')->user()->hasRole('Employee')){
            $company_ids = Company::where('created_by', auth()->user()->created_by)->pluck('id');
            $document = DocumentManagement::whereIn('company_id',$company_ids)->with('companies')->whereHas('companies')
                ->where('service_id',$service_id)
                ->orderBy('created_at', $orderBy)
                ->paginate($count);
            return $document;
        }
        $document = DocumentManagement::with('companies')->whereHas('companies')
            ->where('service_id',$service_id)
            ->orderBy('created_at', $orderBy)
            ->paginate($count);
//        $user = User::with('permissions')->where('id', auth()->guard('web')->user()->id)->first();
        return $document;
//        return [$document,$user];
    }

}
