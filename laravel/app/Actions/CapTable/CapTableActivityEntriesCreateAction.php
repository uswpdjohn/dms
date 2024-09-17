<?php

namespace App\Actions\CapTable;

use App\Models\CapTableActivity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CapTableActivityEntriesCreateAction
{

    public function execute($validatedData)
    {
        DB::beginTransaction();
        try {
            $activity_entries = new CapTableActivity();
            $activity_entries->share_certificate_id = $validatedData['share_certificate_id'];
            $activity_entries->transaction_date = Carbon::parse($validatedData['transaction_date'])->toDateString();
            $activity_entries->funding_round = $validatedData['funding_round'];
            $activity_entries->share_type = $validatedData['share_type'];
            if(key_exists('is_transfer_share', $validatedData)){
                if($validatedData['share_number'] > CapTableActivity::where('company_member_id', $validatedData['company_member_id'])->where('is_transfer_share', false)->sum('share_number')){
                    // return because not enough share available
                    return array('not_enough_share_to_transfer' => true);
                }
                $activity_entries->is_transfer_share = true;
                $activity_entries->share_number = - $validatedData['share_number'];
                $activity_entries->transfer_to_company_member_id = $validatedData['transfer_to_company_member_id'];
            }else{
                $activity_entries->is_transfer_share = false;
                $activity_entries->share_number = $validatedData['share_number'];
            }
            if (!key_exists('amount', $validatedData)){
                $activity_entries->amount = 0.00;
            }else{
                $activity_entries->amount = (float) $validatedData['amount'];
            }

            $activity_entries->company_member_id = $validatedData['company_member_id'];
            $activity_entries->company_id = $validatedData['company_id'];
            if(key_exists('note', $validatedData)){
                $activity_entries->note = $validatedData['note'];
            }
            $activity_entries->save();


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
                $activity_entries->company_id = $validatedData['company_id'];

                $activity_entries->is_transfer_share = false;
//                $activity_entries->transfer_to_company_member_id = $validatedData['transfer_to_company_member_id'];
                if(key_exists('note', $validatedData)){
                    $activity_entries->note = $validatedData['note'];
                }
                $activity_entries->save();
            }
            DB::commit();
            return array('response' => $activity_entries);
        }catch (\Exception $exception){
            DB::rollBack();
            return array('error' => true);
        }
    }
}
