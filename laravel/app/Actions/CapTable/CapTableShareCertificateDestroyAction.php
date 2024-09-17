<?php

namespace App\Actions\CapTable;

use App\Actions\DocumentManagement\DeleteDocumentAction;
use App\Models\ShareCertificate;
use Illuminate\Support\Facades\DB;

class CapTableShareCertificateDestroyAction
{
    public function execute($share_certificate)
    {
        DB::beginTransaction();
        try {
            $share_certificate_data = ShareCertificate::where('id',$share_certificate)->first();
            (new DeleteDocumentAction())->execute($share_certificate_data['document_id']);
            $share_certificate_data->delete();

            $share_certificate_data->certificateSigners()->detach();
            DB::commit();
            return ['success'=>true, 'message' => 'Share Certificate Delete Successfully'];
        }catch (\Exception $exception){
            DB::rollBack();
            return ['success'=> false,'message' => 'Something went wrong'];
        }

    }

}
