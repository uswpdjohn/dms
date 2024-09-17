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
    public function esopDocuments($service_id,$company_id)
    {
        //for admin(using)
        try{
            return (new GetEsopDocumentListAction())->execute($service_id,$company_id, config('paginate.page_count'),'DESC');
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
    public function esopSearch($service_id,$search,$company_id)
    {
        //for admin(using)
        $documents=(new SearchEsopDocumentAction())->execute($search,$service_id,$company_id, 'DESC', config('paginate.page_count'));
        return $documents;
    }
    public function esopFilterByCompany($service_id,$company_id)
    {
        //for admin(using)
        $documents=(new FilterEsopDocumentAction())->execute($service_id,$company_id, 'DESC', config('paginate.page_count'));
        return $documents;
    }

    public function del($document_id)
    {
        //for admin(using
        /*if (auth()->guard('web')->user()->can('delete.document_management')) {
            $documents=(new DeleteDocumentFromInternalDbAction())->execute($document_id);
            return redirect()->route('document-management.index')->with('success', 'Document Deleted Successfully');
        }else{
            abort(403,'You do not have access to this action!');
//            return $response  = array('abort' => '403','message'=> 'Oops! You do not have sufficient permission to delete.');
        }*/



        abort_unless(auth()->guard('web')->user()->can('delete.document_management'), 403, 'You do not have access to this action!');
        try {
            $documents=(new DeleteDocumentFromInternalDbAction())->execute($document_id);
            if (key_exists('action', $documents)){
                return redirect()->route('document-management.index')->with('error', 'Document with completed status can not be deleted');
            }elseif (key_exists('error', $documents)){
                return redirect()->route('document-management.index')->with('error', 'Something went wrong');
            }
            return redirect()->route('document-management.index')->with('success', 'Document Deleted Successfully');
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
    public function esopDel($document_id)
    {

        abort_unless(auth()->guard('web')->user()->can('delete.document_management'), 403, 'You do not have access to this action!');
        try {
            $documents=(new DeleteDocumentFromInternalDbAction())->execute($document_id);
            if (key_exists('action', $documents)){
                return redirect()->route('esop.index')->with('error', 'Document with completed status can not be deleted');
            }elseif (key_exists('error', $documents)){
                return redirect()->route('esop.index')->with('error', 'Something went wrong');
            }
            return redirect()->route('esop.index')->with('success', 'Document Deleted Successfully');
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
    public function edit($document_id)
    {
        //for admin(using)
/*        if (auth()->guard('web')->user()->can('edit.document_management')||auth()->guard('web')->user()->can('view.document_management')) {
            $documents=(new GetDocumentAction())->execute($document_id);
            return  $documents;
        }else{
            return $response  = array('abort' => '403','message'=> 'You do not have access to edit the document.');
        }*/


        abort_if((!auth()->guard('web')->user()->can('edit.document_management'))|| (!auth()->guard('web')->user()->can('view.document_management')), 403, 'You do not have access to this action!');

        try {
            return (new GetDocumentAction())->execute($document_id);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }



    public function uploadDocument(UploadDocumentRequest $request)
    {

        //for admin(using)
        /*try {
            if (auth()->guard('web')->user()->can('create.document_management')) {
                $response = (new UploadDocumentActionApi())->execute($validatedData = $request->validated());
                $documentId = $response->getId();
                return array('success' => '1', 'response' => $response, 'message' => 'Document Uploaded Successfully', 'url' => 'https://app-eval.signnow.com/webapp/document/' . $documentId);
            } else {
                return $response = array('abort' => '403', 'message' => 'You do not have access to create document.');
            }
        }catch(EntityManagerException $exception){
            throw new \Exception('Error: Failed to upload document');
//            throw new \Exception($exception->getMessage());
        }catch (\Exception $exception){
//            var_dump(get_class($exception));
//            die();
//            return array('error' => '0', 'message'=> 'Error: Failed to upload document');
//            throw new \Error($exception->getMessage());
            throw new \Exception('ERROR [SignNow API]: '.$exception->getMessage());
//            return $exception->getMessage();
        }*/



        abort_unless(auth()->guard('web')->user()->can('create.document_management'), 403, 'You do not have access to create document.');
        try{
            $response = (new UploadDocumentActionApi())->execute($validatedData = $request->validated());
            return array(
                'success' => '1',
                'response' => $response,
                'message' => 'Document Uploaded Successfully',
//                'url' => 'https://app-eval.signnow.com/webapp/document/' . $response->getId()
//                'url' => 'https://app.signnow.com/webapp/document/' . $response->getId() //production
            );
        }
//        catch(EntityManagerException $exception){
//            throw new \Exception('ERROR [SignNow API]: '.$exception->getMessage());
//        }
        catch (\Exception $exception){
//            return $exception->getMessage();
            throw new \Exception('Error: Failed to upload document: ', $exception->getCode());
        }

    }
    public function editDocument(EditDocumentRequest $request)
    {
        //for admin(using)
        /*try {
            if (auth()->guard('web')->user()->can('edit.document_management')) {
                $response = (new UploadDocumentActionApi())->execute($validatedData=$request->validated());
                if ($request->file('file')){
                    $documentId=$response->getId();
                }else{
                    $documentId=$request->document_hashed;
                }


                return $response  = array('success' => '1', 'response'=>$response, 'message'=> 'Document Uploaded Successfully', 'url'=> 'https://app-eval.signnow.com/webapp/document/'.$documentId);
//            return response()->json($response);
            }else{
                return $response  = array('abort' => '403','message'=> 'You do not have access to edit the document.');
            }

        }catch(EntityManagerException $exception){
            throw new \Exception('Error: Failed to upload document');
//            throw new \Exception($exception->getMessage());
        }catch (\Exception $exception){
//            var_dump(get_class($exception));
//            die();
//            return array('error' => '0', 'message'=> 'Error: Failed to upload document');
//            throw new \Error($exception->getMessage());
            throw new \Exception('ERROR [SignNow API]: '.$exception->getMessage());
//            return $exception->getMessage();
        }*/


        abort_unless(auth()->guard('web')->user()->can('edit.document_management'), 403, 'You do not have access to edit the document.');

        try{
            $response = (new UploadDocumentActionApi())->execute($validatedData=$request->validated());
//            $documentId= $request->file('file') ? $response->getId() : $request->document_hashed;
            return array(
                'success' => '1',
                'response'=>$response,
                'message'=> 'Document Uploaded Successfully',
//                'url'=> 'https://app-eval.signnow.com/webapp/document/'.$documentId
//                'url'=> 'https://app.signnow.com/webapp/document/'.$documentId //production
            );
        }
//        catch(EntityManagerException $exception){
//            throw new \Exception('Error: Failed to upload document');
//        }
        catch (\Exception $exception){
            throw new \Exception('ERROR [SignNow API]: '.$exception->getMessage());
        }

    }

    public function show($document_id)
    {
        /*return (new ShowDocumentAction())->execute($document_id);*/

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

    public function inviteToSign($document_id)
    {
        //for admin(using)
        $shareholder_and_directors=(new GetDirectorShareholderAction())->execute($document_id);
        return view('documentManagement.invite', ['document' => $document_id, 'shareholder'=>$shareholder_and_directors['shareholders'], 'director'=>$shareholder_and_directors['directors']]);

    }
    public function invite(InviteToSignRequest $request,$document_id)
    {
        //for admin(using)
        /*if (auth()->guard('web')->user()->can('view.document_management')) {
            $response = (new InviteToSignAction())->execute($validatedData=$request->validated(),$document_id);
            if(response($response)->getStatusCode() == 200){
                return $response  = array('success' => '1', 'response'=>$response);
            }else{
                return $response  = array('abort' => '500','message'=> 'Something went wrong');
            }
        }else{
            return $response  = array('abort' => '403','message'=> 'You do not have access to send invitation.');
        }*/



        abort_unless(auth()->guard('web')->user()->can('view.document_management'), 403, 'You do not have access to send invitation.');

        try{
            $response = (new InviteToSignAction())->execute($validatedData=$request->validated(),$document_id);

            if (key_exists('success', $response)){
                return array('success' => '1', 'response'=>$response);
            }elseif (key_exists('failed', $response)){
                return array('abort' => '500', 'message'=>'Failed to send invitations.Check signing field(s)');
            }
            return array('abort' => '500','message'=> 'Something went wrong');
//            return response($response)->getStatusCode() == 200 ?
//                array('success' => '1', 'response'=>$response) :
//                array('abort' => '500','message'=> 'Something went wrong');

        }
        catch(EntityManagerException $exception){
//            throw new \Exception('Error: Failed to invite signers');
            throw new \Exception($exception->getMessage());
        }catch (\Exception $exception){
            throw new \Exception('ERROR [SignNow API]: '.$exception->getMessage());
        }


    }

    public function cancelInvite($document_id)
    {
        //for admin(using)
        $response = (new CancelInviteAction())->execute($document_id);
        return $response;

    }
    //for single
    public function downloadDocument(DocumentDownloadRequest $request)
    {
        try {
            //for customer(using)

            $response = (new DownloadDocumentAction())->execute($validatedData=$request->validated());
            return response()->download(public_path($response))->deleteFileAfterSend(true);
//            $this->downloadLocalDocument($request['document_id'][0]);
        }catch (\Exception $exception){
            return view('documentManagement.admin.requestFailed');
        }
    }
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
//        $response = (new DownloadLocalFileAction())->execute($document_id);
//        dd($response);
        $document = DocumentManagement::where('document_id', $document_id)->pluck('file');

        $file =  Storage::disk('public')->get($document[0]);
        $decrypted = Crypt::decrypt($file);


        $headers = [
            'Content-Type' => 'application/octet-stream',
        ];
        return response()->streamDownload(function () use ( $decrypted) {
            echo $decrypted;
        }, $document[0],$headers);
//        return $path_to_file;
//        return response()->download($response);
    }

    public function refresh($document_id)
    {
        //for admin(using)
        try {
            return (new RefreshDocumentStatusAction())->execute($document_id);
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
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
//            return ['document' => $document];
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


//        return response()->make($decrypt, 200, array(
//            'Content-Type' => 'application/pdf',
//
//        ));
    }


}
