<?php

namespace App\Actions\CapTable;

use App\Helpers\CapTableCompanyHelper;
use App\Models\CapTableActivity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CapTableActivityEntriesUpdateAction
{

    public function execute($validatedData, $id)
    {
        DB::beginTransaction();
        try {
            $item = CapTableActivity::findOrFail($id);

            if($item->is_transfer_share && !key_exists('is_transfer_share', $validatedData)){
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
            $item->share_certificate_id = $validatedData['share_certificate_id'];
            $item->transaction_date = Carbon::parse($validatedData['transaction_date'])->toDateString();
            $item->funding_round = $validatedData['funding_round'];
            $item->share_type = $validatedData['share_type'];

            if(key_exists('is_transfer_share', $validatedData)){
                if($validatedData['share_number'] > CapTableActivity::where('company_member_id', $validatedData['company_member_id'])->where('is_transfer_share', false)->sum('share_number')){
                    // return because not enough share available
                    return array('not_enough_share_to_transfer' => true);
                }

                $item->is_transfer_share = true;
                $item->share_number = - $validatedData['share_number'];
                $item->transfer_to_company_member_id = $validatedData['transfer_to_company_member_id'];
            }else{
                $item->is_transfer_share = false;
                $item->share_number = $validatedData['share_number'];
            }
            if (!key_exists('amount', $validatedData)){
                $item->amount = 0.00;
            }else{
                $item->amount = (float) $validatedData['amount'];
            }
            $item->company_member_id = $validatedData['company_member_id'];
            if(key_exists('note', $validatedData)){
                $item->note = $validatedData['note'];
            }
            $item->save();

            if(key_exists('is_transfer_share', $validatedData)){
                $activity_entries = new CapTableActivity();
                $activity_entries->share_certificate_id = $validatedData['share_certificate_id'];
                $activity_entries->transaction_date = Carbon::parse($validatedData['transaction_date'])->toDateString();
                $activity_entries->funding_round = $validatedData['funding_round'];
                $activity_entries->share_type = $validatedData['share_type'];
                $activity_entries->share_number = $validatedData['share_number'];
                if (!key_exists('amount', $validatedData)){
                    $activity_entries->amount = 0.00;
                }else{
                    $activity_entries->amount = (float) $validatedData['amount'];
                }
                $activity_entries->company_member_id = $validatedData['transfer_to_company_member_id'];
//                $activity_entries->company_member_id = $validatedData['company_member_id'];
                $activity_entries->company_id = CapTableCompanyHelper::get();

                $activity_entries->is_transfer_share = false;
//                $activity_entries->transfer_to_company_member_id = $validatedData['transfer_to_company_member_id'];
                if(key_exists('note', $validatedData)){
                    $activity_entries->note = $validatedData['note'];
                }
                $activity_entries->save();
            }

            DB::commit();
            return array('success' => true);
        }catch (\Exception $exception){
//            throw new \Exception($exception->getMessage());
            DB::rollBack();
            return array('error'=>true);
        }


    }
}
