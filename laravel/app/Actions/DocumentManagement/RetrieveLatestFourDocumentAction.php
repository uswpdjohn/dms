<?php

namespace App\Actions\DocumentManagement;

use App\Actions\Session\SessionAction;
use App\Helpers\Helper;
use App\Models\DocumentManagement;

class RetrieveLatestFourDocumentAction
{
    public function execute($service_id)
    {
        $document=DocumentManagement::where('service_id', $service_id)
            ->where('company_id', Helper::auth_user_company())
            ->latest()
            ->take(4)
            ->get();
        return $document;
    }

}
