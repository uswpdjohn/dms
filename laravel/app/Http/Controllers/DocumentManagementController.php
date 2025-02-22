<?php

namespace App\Http\Controllers;

use App\Actions\DocumentManagement\CancelInviteAction;
use App\Actions\DocumentManagement\CustomerDocumentSearch;
use App\Actions\DocumentManagement\DeleteDocumentAction;
use App\Actions\DocumentManagement\DeleteDocumentFromInternalDbAction;
use App\Actions\DocumentManagement\DocumentIndividualDownloadAction;
use App\Actions\DocumentManagement\DownloadDocumentAction;
use App\Actions\DocumentManagement\DownloadLocalFileAction;
use App\Actions\DocumentManagement\FilterEsopDocumentAction;
use App\Actions\DocumentManagement\GenerateTempFileUrlAction;
use App\Actions\DocumentManagement\GetDirectorShareholderAction;
use App\Actions\DocumentManagement\GetDocumentAction;
use App\Actions\DocumentManagement\GetDocumentListAction;
use App\Actions\DocumentManagement\InviteToSignAction;
use App\Actions\DocumentManagement\RefreshDocumentStatusAction;
use App\Actions\DocumentManagement\RetrieveDocumentAction;
use App\Actions\DocumentManagement\RetrieveLatestFourDocumentAction;
use App\Actions\DocumentManagement\SearchDocumentAction;
use App\Actions\DocumentManagement\SearchEsopDocumentAction;
use App\Actions\DocumentManagement\ShowDocumentAction;
use App\Actions\DocumentManagement\UploadDocumentActionApi;
use App\Actions\ESOP\GetEsopDocumentListAction;
use App\Actions\Session\SessionAction;
use App\Actions\SignNow\signNowOAuthAction;
use App\Api\GetUserApi;
use App\Api\UploadDocumentApi;
use App\Http\Requests\DocumentDownloadRequest;
use App\Http\Requests\EditDocumentRequest;
use App\Http\Requests\GeneralDocumentUpdateRequest;
use App\Http\Requests\GeneralDocumentUploadRequest;
use App\Http\Requests\InviteToSignRequest;
use App\Http\Requests\UploadDocumentRequest;
use App\Models\Company;
use App\Models\CompanyUserSession;
use App\Models\DocumentManagement;
use finfo;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;
use SignNow\Api\Entity\Document\Document;
use SignNow\Api\Entity\Document\Download as DocumentDownload;
use SignNow\Rest\EntityManager\Exception\EntityManagerException;


class DocumentManagementController extends Controller
{

    public function index(Request $request)
    {
        if(auth()->guard('web')->user()->hasRole('General User')){
            return view('documentManagement.generalUser.index');
        }
        abort_unless(auth()->guard('web')->user()->can('create.document_management') ||
            auth()->guard('web')->user()->can('edit.document_management') ||
            auth()->guard('web')->user()->can('view.document_management') ||
            auth()->guard('web')->user()->can('delete.document_management'), 403, 'You do not have access to this action!');
        if(auth()->guard('web')->user()->hasRole('Company Owner')){
            $companies = Company::where('created_by', auth()->user()->id)->get();
        }elseif (auth()->guard('web')->user()->hasRole('Employee')){
            $companies = Company::where('created_by', auth()->user()->created_by)->get();
        }else{
            $companies=Company::all();
        }
        return view('documentManagement.admin.index', array('companies' => $companies));
    }
    public function documents($service_id)
    {
        //for admin(using)
        try{
            return (new GetDocumentListAction())->execute($service_id, config('paginate.page_count'),'DESC');
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
    }


    public function search($service_id,$search)
    {
        //for admin(using)
        $documents=(new SearchDocumentAction())->execute($search,$service_id, 'DESC', config('paginate.page_count'));
        return $documents;
    }

    public function del($document_id)
    {
        if(!auth()->user()->hasRole('General User')){
            abort_unless(auth()->guard('web')->user()->can('delete.document_management'), 403, 'You do not have access to this action!');
        }
        try {
            $documents=(new DeleteDocumentFromInternalDbAction())->execute($document_id);
            return redirect()->route('document-management.index')->with('success', 'Document Deleted Successfully');
        }
        catch (\Exception $exception){
            return redirect()->route('document-management.index')->with('error', 'Something went wrong');
        }

    }

    public function edit($document_id)
    {
        if(!auth()->user()->hasRole('General User')){
            abort_if((!auth()->guard('web')->user()->can('edit.document_management'))|| (!auth()->guard('web')->user()->can('view.document_management')), 403, 'You do not have access to this action!');
        }

        try {
            return (new GetDocumentAction())->execute($document_id);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function uploadDocument(UploadDocumentRequest $request)
    {
        abort_unless(auth()->guard('web')->user()->can('create.document_management'), 403, 'You do not have access to create document.');
        try{
            $response = (new UploadDocumentActionApi())->execute($validatedData = $request->validated());
            return array(
                'success' => '1',
                'response' => $response,
                'message' => 'Document Uploaded Successfully',
            );
        }
        catch (\Exception $exception){
            throw new \Exception('Error: Failed to upload document: ', $exception->getCode());
        }

    }
    public function generalDocumentUpload(GeneralDocumentUploadRequest $request)
    {
        try{
            $company=Company::where('created_by', auth()->user()->id)->first();
            $response = (new UploadDocumentActionApi())->execute($validatedData = $request->validated() + ['company_id' =>$company->id ]);
            return array(
                'success' => '1',
                'response' => $response,
                'message' => 'Document Uploaded Successfully',
            );
        }
        catch (\Exception $exception){
            throw new \Exception('Error: Failed to upload document: ', $exception->getCode());
        }

    }
    public function generalDocumentUpdate(GeneralDocumentUpdateRequest $request)
    {
        try{
            $response = (new UploadDocumentActionApi())->execute($validatedData=$request->validated());
            return array(
                'success' => '1',
                'response'=>$response,
                'message'=> 'Document Uploaded Successfully',
            );
        }
        catch (\Exception $exception){
            throw new \Exception('ERROR: '.$exception->getMessage());
        }

    }
    public function editDocument(EditDocumentRequest $request)
    {
        abort_unless(auth()->guard('web')->user()->can('edit.document_management'), 403, 'You do not have access to edit the document.');

        try{
            $response = (new UploadDocumentActionApi())->execute($validatedData=$request->validated());
//            $documentId= $request->file('file') ? $response->getId() : $request->document_hashed;
            return array(
                'success' => '1',
                'response'=>$response,
                'message'=> 'Document Uploaded Successfully',
            );
        }
        catch (\Exception $exception){
            throw new \Exception('ERROR: '.$exception->getMessage());
        }

    }

    public function show($document_id)
    {
        try {
            return (new ShowDocumentAction())->execute($document_id);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function deleteDocument($id)
    {
        //for admin
        try {
            return (new DeleteDocumentAction())->execute($id);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }

    public function invite(InviteToSignRequest $request,$document_id)
    {
        abort_unless(auth()->guard('web')->user()->can('view.document_management'), 403, 'You do not have access to send invitation.');
        try{
            $response = (new InviteToSignAction())->execute($validatedData=$request->validated(),$document_id);
            if($response){
                return array('success' => '1', 'response'=>$response);
            }

        } catch (\Exception $exception){
            throw new \Exception('ERROR : '.$exception->getMessage());
        }


    }

    //for single

    public function individualDownloadDocument($document_id)
    {
        //for customer(using)
        try {
            $response = (new DocumentIndividualDownloadAction())->execute($document_id);
            return response()->download(public_path($response))->deleteFileAfterSend(true);
        }catch (\Exception $exception){
            return view('documentManagement.admin.requestFailed');
//            return  $exception->getMessage();
        }
    }

    public function downloadLocalDocument($document_id)
    {
        $document = DocumentManagement::where('document_id', $document_id)->pluck('file');

        $file =  Storage::disk('public')->get($document[0]);
        $decrypted = Crypt::decrypt($file);


        $headers = [
            'Content-Type' => 'application/octet-stream',
        ];
        return response()->streamDownload(function () use ( $decrypted) {
            echo $decrypted;
        }, $document[0],$headers);
    }


    public function customerView($service_id,Request $request)
    {
        //for customer
        abort_unless(auth()->guard('web')->user()->hasRole('Company User'), 403, 'You do not have access to this action!');
        try{
            $company_id = CompanyUserSession::where('key', 'company_id')->first();
            if($company_id->value==null){
                $response=(new SessionAction())->execute();
            }
            $latestFour = (new RetrieveLatestFourDocumentAction())->execute($service_id);
            $document = (new RetrieveDocumentAction())->execute($service_id, $request->search, 'ASC');
            return view('documentManagement.customer.index', ['document' => $document, 'latestFour' => $latestFour]);
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
    }


    public function getShareholdersAndDirectors($company_id)
    {
        /*$shareholder_and_directors=(new GetDirectorShareholderAction())->execute($company_id);
        return $shareholder_and_directors;*/

        try {
            return (new GetDirectorShareholderAction())->execute($company_id);
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    public function generateTempUrl($document_id)
    {
        try {
            $response = (new GenerateTempFileUrlAction())->execute($document_id);
            return $response;

        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function downloadFromTempUrl($path)
    {
        $file =  Storage::disk('public')->get($path);
        $decrypted = Crypt::decrypt($file);
        $headers = [
            'Content-Type' => 'application/octet-stream',
        ];
        return response()->streamDownload(function () use ($decrypted) {
            echo $decrypted;
        }, $path,$headers);
    }


}
