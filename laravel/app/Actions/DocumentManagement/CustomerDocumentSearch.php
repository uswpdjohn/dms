<?php

namespace App\Actions\DocumentManagement;

use App\Models\DocumentManagement;
use League\CommonMark\Node\Block\Document;

class CustomerDocumentSearch
{
    public function execute($search)
    {
        $document=DocumentManagement::where('name', 'LIKE', "%$search%")->where('company_id', session()->get('auth_user_company')->id)->get();
//        dd($document);
        return $document;
    }

}
