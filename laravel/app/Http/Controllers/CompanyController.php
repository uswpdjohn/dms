<?php

namespace App\Http\Controllers;

use App\Actions\Company\ChangeCompanyStatusAction;
use App\Actions\Company\CompanyCreateAction;
use App\Actions\Company\CompanyDestroyAction;
use App\Actions\Company\CompanyEditAction;
use App\Actions\Company\CompanyFilterByNameAction;
use App\Actions\Company\CompanyListAction;
use App\Actions\Company\CompanySearchAction;
use App\Actions\Company\CompanyShowAction;
use App\Actions\Company\CompanyUpdateAction;
use App\Actions\Company\CompanyUserCreateAction;
use App\Actions\Company\GetAllSSICAction;
use App\Actions\Company\GetDirectorForEditAction;
use App\Actions\Company\OnKeyUpCompanySearchAction;
use App\Actions\Company\RemoveUserFromCompanyAction;
use App\Actions\Company\SortCompanyAction;
use App\Exports\CompanyExport;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\CreateCompanyUserRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Interfaces\Company\ListCompanyInterface;
use App\Interfaces\Company\RemoveCompanyUserInterface;
use App\Interfaces\Company\ShowCompanyInterface;
use App\Interfaces\Company\StoreCompanyInterface;
use App\Interfaces\Company\UpdateCompanyInterface;
use App\Jobs\DownloadExcel;
use App\Models\Company;
use App\Models\CompanyMember;
use App\Models\SSIC;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CompanyController extends Controller
{

    public function index(Request $request, ListCompanyInterface $interface)
    {
        if (auth()->guard('web')->user()->can('create.company_management') ||
            auth()->guard('web')->user()->can('edit.company_management') ||
            auth()->guard('web')->user()->can('view.company_management') ||
            auth()->guard('web')->user()->can('delete.company_management')){
            if ($request->ajax()){
                $companies = $interface->execute($request->all(),$request->has('page_count') ? $request->page_count : config('paginate.page_count'),'DESC');
                return $companies;
            }
            $companies = $interface->execute($request->all(),$request->has('page_count') ? $request->page_count : config('paginate.page_count'),'DESC');
            return view('company.index',compact('companies'));
        }
        abort(403, 'You do not have access to this action!');

    }

    public function getAllSsic()
    {
        $response = (new GetAllSSICAction())->execute();
       return $response;

    }


    public function filterByName($orderBy)
    {
        $response=(new CompanyFilterByNameAction())->execute($orderBy,config('paginate.page_count'));
        return response()->json($response);
    }


    public function create()
    {
        //
    }


    public function store(CreateCompanyRequest $request, StoreCompanyInterface $interface)
    {
        if (auth()->guard('web')->user()->can('create.company_management')) {
            try {
                $response = $interface->execute($request->validated());
                    return $response = array('success' => '1', 'response' => $response, 'message' => 'New Company Created Successfully');
            } catch (\Exception $exception) {
                throw new \Exception($exception->getMessage());
//                return $exception->getMessage();
            }
        }
        return $response = array('abort' => '403', 'message' => 'You do not have access to create company!');

    }


    public function show($slug, ShowCompanyInterface $interface)
    {
        if (auth()->guard('web')->user()->can('view.company_management')) {
            $response = $interface->execute(['slug'=> $slug]);
            return view('company.view', ['response'=>$response]);
        }else{
            abort(403, 'You do not have access to this action!');
        }

    }


    public function edit($slug)
    {
        if (auth()->guard('web')->user()->can('edit.company_management')) {
            $ssics = SSIC::all();
            $response = (new CompanyEditAction())->execute($slug);
            return view('company.edit', ['response'=>$response, 'ssics'=>$ssics]);
        }else{
            abort(403, 'You do not have access to this action!');
        }
    }


    public function update(UpdateCompanyRequest $request, $slug, UpdateCompanyInterface $interface){
        $response = $interface->execute($request->validated(), $slug);
        if(response($response)->getStatusCode() == 200){
            return redirect()->route('company.edit', $slug)->with('success','Information are saved successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug){
        if (auth()->guard('web')->user()->can('delete.company_management')) {
            $response = (new CompanyDestroyAction())->execute($slug);
             if(response($response)->getStatusCode() == 200){
                 return redirect()->route('company.index')->with('success', 'Company Deleted Successfully');
             }
        }else{
            abort(403, 'You do not have access to this action!') ;
        }
    }

    public function searchCompany($search)
    {
//        var_dump($search);die();
        $response=(new CompanySearchAction())->execute($search, 'DESC', config('paginate.page_count'));
        return $response;

    }

    public function removeFromCompany(Request $request, RemoveCompanyUserInterface $interface)
    {
        $message='';
        $response= $interface->execute(['slug'=> $request->slug, 'company_id' => $request->company_id, 'user_type' => $request->user_type]);
        if (response($response)->getStatusCode() == 200){
            if ($request->user_type=='user'){
                $message='User removed successfully';
            }elseif ($request->user_type=='director'){
                $message='Director removed successfully';
            }else{
                $message='Shareholder removed successfully';
            }
            return $response   = array('success' => '1', 'response'=>$response, 'message'=>$message);
        }
        return $response;

    }

    public function export()
    {
        $fileName='companies.xlsx';
        (new CompanyExport)->store($fileName); //with queue
        return Storage::download($fileName);
    }

    public function userWithNoCompany()
    {
        return view('company.userWithNoCompany');
    }

    public function changeStatus($id)
    {
        $response = (new ChangeCompanyStatusAction())->execute($id);
        return $response;
    }

    public function sort($sortBy,$currentDirection)
    {
        try {
            $response = (new SortCompanyAction())->execute($sortBy,$currentDirection, config('paginate.page_count'));
            return $response;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }

    }

    public function getDirectorForEdit($slug){
        $response = (new GetDirectorForEditAction())->execute($slug);
        return $response;

    }
    public function getShareholderForEdit($slug){
        $response = (new GetDirectorForEditAction())->execute($slug);
        return $response;

    }


    public function makeDirectory()
    {
        try {
            $companies = Company::all();
            $categories = ['Mailbox', 'Corporate Secretary', 'Tax', 'Accounting', 'Human Resource'];
            foreach ($companies as $company){
                $directory_name = 'company_'. $company->id;
                foreach ($categories as $category){
                    if(!Storage::disk('public')->exists('mailbox/'.$directory_name.'/'. $category)){
                        Storage::disk('public')->makeDirectory('mailbox/'.$directory_name.'/'. $category);
                    }
                }
            }
            return redirect()->route('mail.admin.index')->with('success', 'Directory created successfully for companies');
        }catch (\Exception $exception){
            return view(500);
        }

    }



}
