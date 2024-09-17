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
//            $users=(new CompanyManagementCreateAction())->execute($validatedData=$request->validated());
            $users = $interface->execute($request->validated());
            return $users;

        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function update(UpdateCompanyManagementRequest $request,$slug, UpdateCompanyManagementInterface $interface)
    {
        try {
//            abort_unless(auth()->guard('web')->user()->can('edit.company_management'), 403, 'You do not have access to this action!');
//            $response=(new CompanyManagementUpdateAction())->execute($validatedData=$request->validated(),$slug);
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
//                $response =(new CompanyManagementDestroyAction())->execute($slug);
                $response =$interface->execute(['slug' => $slug]);
                return $response;
            }catch(\Exception $e) {
                return $e->getMessage();
            }
        }

//    public function show($id)
//    {
//        $responses=(new CompanyManagementShowAction())->execute($id);
//        return view('companyManagement.info', ['responses'=>$responses]);
//    }

    public function setCompany($id)
    {
        try {
            $company=Company::findOrFail($id);
            $data=CompanyUserSession::where('id',1)->first();
            $data->update(['value'=> $company->id]);
            return true;





//            session()->forget('auth_user_company');
////            session(['auth_user_company' => $company]);
//            session()->put('auth_user_company', $company);
//            return session()->get('auth_user_company');
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
}
