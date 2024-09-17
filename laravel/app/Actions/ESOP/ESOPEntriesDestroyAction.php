<?php

namespace App\Actions\ESOP;

use App\Models\ESOP;
use Illuminate\Support\Facades\DB;

class ESOPEntriesDestroyAction
{
    public function execute($id)
    {
        DB::beginTransaction();
        try {
            $item = ESOP::findOrFail($id);
            $item->delete();
            DB::commit();
            return array('success' => true);
        }catch (\Exception $exception){
            DB::rollBack();
            return array('error'=>true,'message'=> $exception->getMessage());
        }

    }
}
