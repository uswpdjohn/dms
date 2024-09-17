<?php

namespace App\Actions\Invoice;

use App\Actions\Session\SessionAction;
use App\Models\Invoice;

class InvoiceCustomerListAction
{
    public function execute($count,$orderBy,$request)
    {
        $company = (new SessionAction())->execute();
        return Invoice::with(['user','company'])
            ->where('company_id',session()->get('auth_user_company')->id ?? '')
            ->where('status', '!=', 'void')
            ->orderBy('created_at',$orderBy)
            ->paginate($count);

    }

}
