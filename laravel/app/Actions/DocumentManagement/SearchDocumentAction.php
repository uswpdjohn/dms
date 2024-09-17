<?php

namespace App\Actions\DocumentManagement;

use App\Models\Company;
use App\Models\DocumentManagement;

class SearchDocumentAction
{
    public function execute($search,$service_id,$orderBy,$count)
    {

        if($search != 0){
            if(auth()->guard('web')->user()->hasRole('Company Owner')){
                $company_ids= Company::where('created_by', auth()->user()->id)->pluck('id');
                $document = DocumentManagement::with('companies')
                    ->whereIn('company_id',$company_ids)
                    ->where('service_id',$service_id)
                    ->where(function ($query) use($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('status', 'like', '%' . $search . '%');
                    })
                    ->orderBy('created_at', $orderBy)->paginate($count);
                return $document;
            }else if (auth()->guard('web')->user()->hasRole('Employee')){
                $company_ids= Company::where('created_by', auth()->user()->created_by)->pluck('id');
                $document = DocumentManagement::with('companies')
                    ->whereIn('company_id',$company_ids)
                    ->where('service_id',$service_id)
                    ->where(function ($query) use($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('status', 'like', '%' . $search . '%');
                    })
                    ->orderBy('created_at', $orderBy)->paginate($count);
                return $document;
            }
            $document = DocumentManagement::with('companies')
                ->where('service_id',$service_id)
                ->where(function ($query) use($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                })
                ->orderBy('created_at', $orderBy)->paginate($count);
            return $document;
        }else{
            if(auth()->guard('web')->user()->hasRole('Company Owner')) {
                $company_ids = Company::where('created_by', auth()->user()->id)->pluck('id');
                $document = DocumentManagement::with('companies')
                    ->whereIn('company_id',$company_ids)
                    ->where('service_id',$service_id)
                    ->orderBy('created_at', $orderBy)->paginate($count);
                return $document;
            }else if (auth()->guard('web')->user()->hasRole('Employee')){
                $company_ids= Company::where('created_by', auth()->user()->created_by)->pluck('id');
                $document = DocumentManagement::with('companies')
                    ->whereIn('company_id',$company_ids)
                    ->where('service_id',$service_id)
                    ->orderBy('created_at', $orderBy)->paginate($count);
                return $document;
            }

            $document = DocumentManagement::with('companies')
                ->where('service_id',$service_id)
                ->orderBy('created_at', $orderBy)->paginate($count);
            return $document;
        }



    }

}
