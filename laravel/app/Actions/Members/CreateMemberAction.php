<?php

namespace App\Actions\Members;

use App\Models\CompanyMember;
use Illuminate\Support\Facades\DB;

class CreateMemberAction
{
    public function execute($validatedData)
    {
        DB::beginTransaction();
        try {
            $member = CompanyMember::create($validatedData);
            DB::commit();
            return array('response' => $member);
        }catch (\Exception $exception){
            DB::rollBack();
            return array('error' => true);
        }

    }
}
