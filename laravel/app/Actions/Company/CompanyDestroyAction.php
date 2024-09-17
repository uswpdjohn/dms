<?php

namespace App\Actions\Company;


use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyDestroyAction
{
    public function execute($slug)
    {
        DB::beginTransaction();
        try {
            $company = Company::where('slug', $slug)->first();
            $company->delete();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }
    }
}
