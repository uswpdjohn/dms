<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyManagementRequest;
use App\Http\Requests\UpdateCompanyManagementRequest;
use App\Interfaces\CompanyManagement\DeleteCompanyManagementInterface;
use App\Interfaces\CompanyManagement\StoreCompanyManagementInterface;
use App\Interfaces\CompanyManagement\UpdateCompanyManagementInterface;
use App\Models\Company;
use App\Models\CompanyUserSession;
use Illuminate\Support\Facades\DB;
use PhpParser\Lexer\TokenEmulator\FlexibleDocStringEmulator;

class CompanyManagementController extends Controller
{
    public function index()
    {

    }

    public function edit()
    {
        return view('companyManagement.edit');
    }
    public function store(CreateCompanyManagementRequest $request, StoreCompanyManagementInterface $interface)
    {
        try {
            $users = $interface->execute($request->validated());
            return $users;

        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function update(UpdateCompanyManagementRequest $request,$slug, UpdateCompanyManagementInterface $interface)
    {
        try {
            $response = $interface->execute($request->validated(), $slug);
            $message = '';
            $status = '';
            if (key_exists('success', $response)){
                $status='success';
                $response['user_type'] == 'director' ? $message = 'Director updated successfully' : $message = 'Shareholder updated successfully';
            }elseif (key_exists('error', $response)){
                $status='error';
                $response['user_type'] == 'director' ? $message = 'Failed to update director' : $message = 'Failed to update shareholder';
            }
            return redirect()->route('company.edit', $request->company_slug)->with($status,$message);

        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }


        public function destroy($slug, DeleteCompanyManagementInterface $interface)
        {
            try{
                $response =$interface->execute(['slug' => $slug]);
                return $response;
            }catch(\Exception $e) {
                return $e->getMessage();
            }
        }


    public function setCompany($id)
    {
        try {
            $company=Company::findOrFail($id);
            $data=CompanyUserSession::where('id',1)->first();
            $data->update(['value'=> $company->id]);
            return true;

        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
}
