<?php

namespace App\Actions\DocumentManagement;

use App\Models\DocumentManagement;

class FilterEsopDocumentAction
{
    public function execute($service_id,$company_id,$orderBy,$count)
    {
//        $document = DocumentManagement::with('companies')
//            ->where('service_id',$service_id)
//            ->where('name','LIKE', "%$search%")
//            ->orderBy('name', $orderBy)->paginate($count);
//        if( $company_id != 0){
            $document = DocumentManagement::with('companies')
                ->where('service_id',$service_id)
                ->where('company_id',$company_id)
                ->orderBy('created_at', $orderBy)->paginate($count);
            return $document;
//        }
//        elseif ($search != 0 && $company_id == 0){
//            $document = DocumentManagement::with('companies')
//                ->where('service_id',$service_id)
//                ->where(function ($query) use($search) {
//                    $query->where('name', 'like', '%' . $search . '%')
//                        ->orWhere('status', 'like', '%' . $search . '%');
//                })
//                ->orderBy('created_at', $orderBy)->paginate($count);
//            return $document;
//        } else{
//            $document = DocumentManagement::with('companies')
//                ->where('service_id',$service_id)
//                ->orderBy('created_at', $orderBy)->paginate($count);
//            return $document;
//        }
//


    }

}
