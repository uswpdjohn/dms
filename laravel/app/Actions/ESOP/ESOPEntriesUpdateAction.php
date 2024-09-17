<?php

namespace App\Actions\ESOP;

use App\Helpers\EsopCompanyHelper;
use App\Models\ESOP;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ESOPEntriesUpdateAction
{

    public function execute($validatedData, $id)
    {
        DB::beginTransaction();
        try {
            $item = ESOP::findOrFail($id);
            $existing_no_of_share = $item->no_of_share;
            if($validatedData['no_of_share'] != $existing_no_of_share && $validatedData['status'] == "issued" || $validatedData['no_of_share'] != $existing_no_of_share && $validatedData['status'] == "exercised"){
                if($validatedData['no_of_share'] + ESOP::where('company_id', $validatedData['company_id'])->where('status', 'issued')->sum('no_of_share') + ESOP::where('company_id', $validatedData['company_id'])->where('status', 'exercised')->sum('no_of_share') > ESOP::where('company_id', $validatedData['company_id'])->where('status', 'reserved')->sum('no_of_share') + $existing_no_of_share){
                    // return because not enough share available
                    return array('not_enough_share_to_transfer' => true);
                }
            }

            $item->status = $validatedData['status'];
            $item->vesting_period = $validatedData['vesting_period'];
            $item->no_of_share = $validatedData['no_of_share'];
            $item->issue_date = Carbon::parse($validatedData['issue_date'])->toDateString();
            $item->granted_date = Carbon::parse($validatedData['granted_date'])->toDateString();
            $item->company_member_id = $validatedData['company_member_id'];
            if(key_exists('reminder_date', $validatedData)){
                $item->reminder_date = Carbon::parse($validatedData['reminder_date'])->toDateString();
            }
            if(key_exists('first_reminder_email', $validatedData)){
                $item->first_reminder_email = $validatedData['first_reminder_email'];
            }
            if(key_exists('second_reminder_email', $validatedData)){
                $item->second_reminder_email = $validatedData['second_reminder_email'];
            }
            if(key_exists('third_reminder_email', $validatedData)){
                $item->third_reminder_email = $validatedData['third_reminder_email'];
            }
            if(key_exists('forth_reminder_email', $validatedData)){
                $item->forth_reminder_email = $validatedData['forth_reminder_email'];
            }
            if(key_exists('fifth_reminder_email', $validatedData)){
                $item->fifth_reminder_email = $validatedData['fifth_reminder_email'];
            }
            if(key_exists('note', $validatedData)){
                $item->note = $validatedData['note'];
            }
            $item->save();
            // return $item;

            DB::commit();
            return array('success' => true,'data'=>$item);
        }catch (\Exception $exception){
//            throw new \Exception($exception->getMessage());
            DB::rollBack();
            return array('error'=>true,'message'=> $exception->getMessage());
        }


    }
}
