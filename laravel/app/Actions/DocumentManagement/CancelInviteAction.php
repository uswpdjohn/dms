<?php

namespace App\Actions\DocumentManagement;

use App\Actions\SignNow\signNowOAuthAction;
use Illuminate\Support\Facades\Session;
use SignNow\Api\Entity\Invite\CancelInvite;
use SignNow\Rest\Http\Request;
class CancelInviteAction
{
    public function execute($document_id)
    {
        $entityManager=(new signNowOAuthAction())->execute();
        $cancel = $entityManager
            ->setUpdateHttpMethod(Request::METHOD_PUT)
            ->update(new CancelInvite(), ['documentId' => $document_id]);
        Session::flash('success', 'Invitation Cancelled Successfully. Please invite again to sign');
        return true;
//        return response()->json($cancel)->getStatusCode();

    }

}
