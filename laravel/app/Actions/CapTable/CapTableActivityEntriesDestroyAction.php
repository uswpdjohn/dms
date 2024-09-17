<?php

namespace App\Actions\CapTable;

use App\Models\CapTableActivity;
use Illuminate\Support\Facades\DB;

class CapTableActivityEntriesDestroyAction
{
    public function execute($id)
    {
        DB::beginTransaction();
        try {
            $item = CapTableActivity::findOrFail($id);
            if($item->is_transfer_share){
                // find and delete the second entry
                $data = CapTableActivity::where('share_certificate_id', $item->share_certificate_id)
                    ->where('transaction_date', $item->transaction_date)
                    ->where('funding_round', $item->funding_round)
                    ->where('share_type', $item->share_type)
                    ->where('share_number', abs($item->share_number))
                    ->where('company_member_id', $item->transfer_to_company_member_id)
                    ->where('amount', $item->amount)
                    ->where('is_transfer_share', false)
                    ->first();
                if ($data!=null){
                    $data->delete();
                }
            }
            $item->delete();
            DB::commit();
            return array('success' => true);
        }catch (\Exception $exception){
            DB::rollBack();
            return array('error'=>true);
        }

    }
}
