<?php

namespace App\Actions\Company;


use App\Interfaces\Company\UpdateCompanyInterface;
use App\Models\Company;
use App\Models\CompanyServices;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

/*
 * TODO
*/

class CompanyUpdateAction implements UpdateCompanyInterface
{
    public static function execute($validatedData,$slug)
    {
//        dd($validatedData);
        DB::beginTransaction();
        try {
            $item = Company::where('slug', $slug)->first();
            $validatedData['created_by'] = Auth::guard('web')->user()->id;
            $incorporation_date = Carbon::parse($validatedData['incorporation_date']);
            $validatedData['company_age'] = Carbon::parse($incorporation_date)->age;
            if (empty($validatedData['gst_reg_no'])) {
                unset($validatedData['gst_reg_no']);
            }
            if (request()->hasFile('image')) {
                $image=$validatedData['image'];
                $imageName = time() . '.' . $image->getClientOriginalName();
                $contents = file_get_contents($validatedData['image']);
                file_put_contents(public_path('/assets/images/'.$imageName),$contents); //put the content in local storage
                if ($item->image != null){
                    $preImage = $item->image;
                    unlink(public_path('/assets/images/'.$preImage));
//                    Storage::delete('public/company/'.  $preImage);
                }
                $validatedData['image']=$imageName;
            }
            $updated_company = $item->update($validatedData);
            if ($updated_company){
                DB::commit();
                return $item;
            }

        }catch(\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }
}
