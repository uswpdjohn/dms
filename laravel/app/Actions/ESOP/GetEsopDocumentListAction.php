<?php

namespace App\Actions\ESOP;

use App\Models\DocumentManagement;

class GetEsopDocumentListAction
{
    public function execute($service_id,$company_id,$count,$orderBy)
    {
        $document = DocumentManagement::with('companies')->whereHas('companies')
            ->where('service_id',$service_id)
            ->where('company_id',$company_id)
            ->orderBy('created_at', $orderBy)
            ->paginate($count);
        return $document;
    }

}
