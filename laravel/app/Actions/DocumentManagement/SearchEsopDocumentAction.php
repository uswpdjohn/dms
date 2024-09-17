<?php

namespace App\Actions\DocumentManagement;

use App\Models\DocumentManagement;

class SearchEsopDocumentAction
{
    public function execute($search,$service_id,$company_id,$orderBy,$count)
    {
        if($search != 0){
            $document = DocumentManagement::with('companies')
                ->where('service_id',$service_id)
                ->where('company_id',$company_id)

                ->where(function ($query) use($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                })
                ->orderBy('created_at', $orderBy)->paginate($count);
            return $document;
        } else{
            $document = DocumentManagement::with('companies')
                ->where('service_id',$service_id)
                ->where('company_id',$company_id)
                ->orderBy('created_at', $orderBy)->paginate($count);
            return $document;
        }



    }

}
