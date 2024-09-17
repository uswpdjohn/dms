<?php

namespace App\Actions\ESOP;

use App\Models\ESOP;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ESOPEntriesCreateAction
{
    public function execute($validatedData)
    {
        DB::beginTransaction();
        try {
            $esop_entry = new ESOP();
            if($validatedData['status'] == "issued" || $validatedData['status'] == "exercised"){
                if($validatedData['no_of_share'] + ESOP::where('company_id', $validatedData['company_id'])->where('status', 'issued')->sum('no_of_share') + ESOP::where('company_id', $validatedData['company_id'])->where('status', 'exercised')->sum('no_of_share') > ESOP::where('company_id', $validatedData['company_id'])->where('status', 'reserved')->sum('no_of_share')){
                    // return because not enough share available
                    return array('not_enough_share_to_transfer' => true);
                }
            }
            
            $esop_entry->status = $validatedData['status'];
            $esop_entry->vesting_period = $validatedData['vesting_period'];
            $esop_entry->no_of_share = $validatedData['no_of_share'];
            $esop_entry->issue_date = Carbon::parse($validatedData['issue_date'])->toDateString();
            $esop_entry->granted_date = Carbon::parse($validatedData['granted_date'])->toDateString();
            if(key_exists('reminder_date', $validatedData)){
                $esop_entry->reminder_date = Carbon::parse($validatedData['reminder_date'])->toDateString();
            }
            if(key_exists('first_reminder_email', $validatedData)){
                $esop_entry->first_reminder_email = $validatedData['first_reminder_email'];
            }
            if(key_exists('second_reminder_email', $validatedData)){
                $esop_entry->second_reminder_email = $validatedData['second_reminder_email'];
            }
            if(key_exists('third_reminder_email', $validatedData)){
                $esop_entry->third_reminder_email = $validatedData['third_reminder_email'];
            }
            if(key_exists('forth_reminder_email', $validatedData)){
                $esop_entry->forth_reminder_email = $validatedData['forth_reminder_email'];
            }
            if(key_exists('fifth_reminder_email', $validatedData)){
                $esop_entry->fifth_reminder_email = $validatedData['fifth_reminder_email'];
            }
            if(key_exists('note', $validatedData)){
                $esop_entry->note = $validatedData['note'];
            }
            $esop_entry->company_member_id = $validatedData['company_member_id'];
            $esop_entry->company_id = $validatedData['company_id'];
            $esop_entry->save();   
            DB::commit();
            return array('response' => $esop_entry);
        }catch (\Exception $exception){
            DB::rollBack();
            return array('error' => true);
        }
    }

}
