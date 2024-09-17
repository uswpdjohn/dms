<?php

namespace App\Actions\DocumentManagement;

use App\Models\DocumentManagement;
use Illuminate\Support\Facades\DB;

class ShowDocumentAction
{
    public function execute($document_id)
    {
        $user_type=[];
        $document = DocumentManagement::with(['signers','companies'])->where('id', $document_id)->first();
        foreach ($document->signers as $signer){
            $company_users = DB::table('company_users')->where('user_id',$signer->id )->first();
            array_push($user_type, ['id'=>$company_users->user_id, 'user_type'=>$company_users->user_type]);
        }

//        $document_signers = DB::table('document_signers')->where('document_id', $document_id)->get();
        return [$document,$user_type];
    }

}
