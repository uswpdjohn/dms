<?php

namespace App\Actions\Invoice;

use App\Models\Company;
use App\Models\Invoice;

class SearchInvoiceAction
{
    public function execute($search,$orderBy,$count,$request)
    {
        if ($search != '0'){
            $companies=Company::where('name', 'LIKE', "%$search%")->get();
            $companyId=[];
            if ($companies != null){
                foreach ($companies as $company){
                    array_push($companyId, $company->id);
                }
                if(!empty($companyId)){
                    if ($request->status != 'all'){
                        $invoice= Invoice::with(['user','company'])->WhereIn('company_id',($companyId))->where('status', $request->status)
                            ->orderBy('created_at', $orderBy)
                            ->paginate($count);
                        return $invoice;
                    }
                    $invoice= Invoice::with(['user','company'])->WhereIn('company_id',($companyId))
                        ->orderBy('created_at', $orderBy)
                        ->paginate($count);
                    return $invoice;
                }
            }
            if ($request->status != 'all'){
                $invoice=Invoice::with(['user','company'])->where('status',$request->status)
                    ->where('invoice_no', 'LIKE', "%$search%")
                    ->orderBy('created_at', $orderBy)->paginate($count);
                return $invoice;
            }
            $invoice=Invoice::with(['user','company'])->where('invoice_no', 'LIKE', "%$search%")
                ->orderBy('created_at', $orderBy)->paginate($count);
            return $invoice;
        }else{
            if ($request->status != 'all'){
                $invoice=Invoice::with(['user', 'company'])->where('status',$request->status)->orderBy('created_at', $orderBy)->paginate($count);
                return $invoice;
            }
            $invoice=Invoice::with(['user', 'company'])->orderBy('created_at', $orderBy)->paginate($count);
            return $invoice;
        }

    }

}
