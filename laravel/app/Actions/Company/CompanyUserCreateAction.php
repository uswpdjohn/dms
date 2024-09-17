<?php

namespace App\Actions\Company;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PharIo\Version\Exception;

class CompanyUserCreateAction
{
    public function execute($validatedData)
    {
        DB::beginTransaction();
        try {
            if ($validatedData) {
                $company = Company::where('id', $validatedData['company_id'])->first();
                $response = $company->users()->attach($validatedData['user_id'], ['user_type' => $validatedData['user_type']]);

                if (response($response)->getStatusCode() == 200) {
                    if ($validatedData['user_type'] == 'user'){
                        Session::flash('success', 'User Added Successfully');
                    }elseif ($validatedData['user_type'] == 'director'){
                        Session::flash('success', 'Director Added Successfully');
                    }elseif ( $validatedData['user_type'] == 'shareholder'){
                        Session::flash('success', 'Shareholder Added Successfully');
                    }
                }
                DB::commit();
                return $response;
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }




//            $directors = $validatedData['director'];
//            $shareholders = $validatedData['shareholder'];
//            $users = $validatedData['user'];
//            $item->users()->detach();
//            if ($directors) {
//                $item->users()->attach($directors, ['user_type' => "director"]);
//            }
//            if ($shareholders) {
//                $item->users()->attach($shareholders, ['user_type' => "shareholder"]);
//            }
//            if ($users) {
//                $item->users()->attach($users, ['user_type' => "user"]);
//            }

    }

}
