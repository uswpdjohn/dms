<?php

namespace App\Actions\DocumentManagement;

use App\Models\Company;
use App\Models\DocumentManagement;

class GetDocumentAction
{
    public function execute($document_id)
    {
        $document = DocumentManagement::with(['signers','companies'])
            ->whereHas('companies')
            ->where('id',$document_id)->first();

        if(auth()->guard('web')->user()->hasRole('Company Owner')){
            $companies = Company::where('created_by', auth()->user()->id)->get();
        }elseif (auth()->guard('web')->user()->hasRole('Employee')){
            $companies = Company::where('created_by', auth()->user()->created_by)->get();
        }else{
            $companies=Company::all();
        }
        return [$document,$companies];

    }

}
