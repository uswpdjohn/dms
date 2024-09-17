<?php

namespace App\Actions\ESOP\Customer\Document;

use App\Actions\Session\SessionAction;
use App\Models\DocumentManagement;

class RetrieveLatestFourDocumentAction
{
    public function execute($service_id)
    {
        $response=(new SessionAction())->execute();
        $document=DocumentManagement::where('service_id', $service_id)
            ->where('company_id', session()->get('auth_user_company')->id)
            ->latest()
            ->take(4)
            ->get();
        return $document;
    }

}
