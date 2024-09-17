<?php

namespace App\Actions\Company;


use App\Interfaces\Company\StoreCompanyInterface;
use App\Models\Company;
use App\Models\CompanyServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CompanyCreateAction implements StoreCompanyInterface
{
    public static function execute($validatedData){

        $incorporation_date = Carbon::parse($validatedData['incorporation_date']);
        $company_age= Carbon::createFromDate($incorporation_date)->diff(Carbon::now())->format('%y years  %m months');
        DB::beginTransaction();
        try {
            $company = new Company();
            $company->name=$validatedData['name'];
            $company->uen=$validatedData['uen'];
            $company->fye=$validatedData['fye'];
            if (key_exists('last_ar_filed', $validatedData)){
                $company->last_ar_filed=$validatedData['last_ar_filed'];
            }
            if (key_exists('last_agm_filed', $validatedData)){
                $company->last_agm_filed=$validatedData['last_agm_filed'];
            }

            if (!empty($validatedData['gst_reg_no'])){
                $company->gst_reg_no=$validatedData['gst_reg_no'];
            }
            $company->incorporation_date=$validatedData['incorporation_date'];
            $company->company_age=$company_age;
//        $company->no_of_employees=$validatedData['no_of_employees'];
//        $company->no_of_offices=$validatedData['no_of_offices'];
            $company->primary_industry_service_ssic_id=$validatedData['primary_industry_service_ssic_id'];
            $company->secondary_industry_service_ssic_id=$validatedData['secondary_industry_service_ssic_id'];
            $company->address_line=$validatedData['address_line'];
             if(\auth()->guard('web')->user()->hasRole('Employee')){
                $company->created_by= Auth::guard('web')->user()->created_by;
            }else{
                 $company->created_by= Auth::guard('web')->user()->id;
             }

            $saveCompany=$company->save();
            DB::commit();

            Session::flash('success', 'New Company Created Successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }

        return $company;
    }
}
