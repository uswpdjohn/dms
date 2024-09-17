<?php

namespace App\Http\Controllers;

use App\Actions\Mailbox\MailboxCreateAction;
use App\Actions\Mailbox\MailboxCustomerSearchAction;
use App\Actions\Mailbox\MailboxDestroyAction;
use App\Actions\Mailbox\MailboxDownloadAction;
use App\Actions\Mailbox\MailboxGeAdminMailByPriorityAction;
use App\Actions\Mailbox\MailboxGetAdminMailByCategory;
use App\Actions\Mailbox\MailboxGetMailByCategory;
use App\Actions\Mailbox\MailboxGetMailByCompanyAction;
use App\Actions\Mailbox\MailboxGetMailByPriorityAction;
use App\Actions\Mailbox\MailboxIndividualDeleteAction;
use App\Actions\Mailbox\MailboxIndividualDownloadAction;
use App\Actions\Mailbox\MailboxListAction;
use App\Actions\Mailbox\MailboxListActionAdmin;
use App\Actions\Mailbox\MailboxMarkAsDownloadedAction;
use App\Actions\Mailbox\MailboxRenameDirectoryAction;
use App\Actions\Mailbox\MailboxSearchAction;
use App\Actions\Mailbox\MailboxUpdateAction;
use App\Actions\Session\SessionAction;
use App\Helpers\Helper;
use App\Http\Requests\CreateMailRequest;
use App\Http\Requests\DeleteMailRequest;
use App\Http\Requests\DownloadMailRequest;
use App\Http\Requests\MailboxDeleteRequest;
use App\Http\Requests\RenameMailboxDirectoryRequest;
use App\Interfaces\Mailbox\DeleteBulkMailboxInterface;
use App\Interfaces\Mailbox\DeleteIndividualMailboxInterface;
use App\Interfaces\Mailbox\GetAdminMailByCategoryInterface;
use App\Interfaces\Mailbox\GetAdminMailByPriorityInterface;
use App\Interfaces\Mailbox\GetMailByCategoryInterface;
use App\Interfaces\Mailbox\GetMailByPriorityInterface;
use App\Interfaces\Mailbox\ListAdminMailboxInterface;
use App\Interfaces\Mailbox\ListMailboxInterface;
use App\Interfaces\Mailbox\SearchCustomerMailboxInterface;
use App\Interfaces\Mailbox\SearchMailboxInterface;
use App\Interfaces\Mailbox\StoreMailboxInterface;
use App\Models\Company;
use App\Models\CompanyUserSession;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;
use Spatie\Permission\Models\Role;

class MailboxController extends Controller
{
    public function index(Request $request, ListMailboxInterface $interface)
    {

//        if (auth()->guard('web')->user()->can('index.mailbox_customer')) {
        if (auth()->guard('web')->user()->hasRole('Company User')) {
          $company_id = CompanyUserSession::where('key', 'company_id')->first();
            if($company_id->value==null){
                $response=(new SessionAction())->execute();
            }
            $user=Auth::guard('web')->user();
    //        abort_if(Gate::denies('mail_customer_access'),403);
    //        if ($user->can('mailbox_customer_access')) {
                if (count(auth()->user()->companies) > 0){
                    $companyId=Helper::auth_user_company();
                    if ($request->ajax()){
//                        $mails = (new MailboxListAction())->execute($request->has('per_page') ? $request->per_page : config('paginate.page_count'), 'DESC', $companyId,$request);
                        $mails = $interface->execute($request,$request->has('per_page') ? $request->per_page : config('paginate.page_count'), 'DESC', $companyId);
                        return $mails;
                    }
                    $mails = $interface->execute($request,$request->has('per_page') ? $request->per_page : config('paginate.page_count'), 'DESC', $companyId);
                    return view('mailbox.outbox', ['mails' => $mails]);
                }
                throw new \Exception('Oops! We are unable to find you on any of companies');

        }else{
            abort(403, 'You do not have access to this action!');
        }

    }
    public function adminIndex(Request $request, ListAdminMailboxInterface $interface)
    {
        if (auth()->guard('web')->user()->can('create.mailbox') ||
            auth()->guard('web')->user()->can('edit.mailbox') ||
            auth()->guard('web')->user()->can('delete.mailbox') ||
            auth()->guard('web')->user()->can('view.mailbox')) {
            if(\auth()->guard('web')->user()->hasRole('Company Owner')){
                $company=Company::where('created_by', \auth()->user()->id)->get();
            }
            else if(\auth()->guard('web')->user()->hasRole('Employee')){
                $company=Company::where('created_by', \auth()->user()->created_by)->get();
            }else{
                $company=Company::all();
            }

            if ($request->ajax()){
//                $mails=(new MailboxListActionAdmin())->execute($request->has('per_page') ? $request->per_page : config('paginate.page_count'),'DESC',$request);
                $mails=$interface->execute($request,$request->has('per_page') ? $request->per_page : config('paginate.page_count'),'DESC');
                return $mails;
            }
            $mails=$interface->execute($request,$request->has('per_page') ? $request->per_page : config('paginate.page_count'),'DESC');


            return view('mailbox.mailbox-admin', ['mails'=>$mails,'company'=>$company]);
        }else{
            abort(403,'You do not have access to this action!');
        }

    }
    public function store(CreateMailRequest $request, StoreMailboxInterface $interface)
    {
        if (auth()->guard('web')->user()->can('create.mailbox')) {
            try {
//                $response = (new MailboxCreateAction())->execute($validatedData=$request->validated());
                $response = $interface->execute($request->validated());
                if (gettype($response) == 'array' && key_exists('success', $response)){
                    return redirect()->route('mail.admin.index')->with('success', 'Mail created successfully.');
                }elseif (gettype($response) == 'array' && key_exists('send_mail', $response)){
                    return redirect()->route('mail.admin.index')->with('error','An error occurred when notifying via email');
                }elseif (gettype($response) == 'array' && key_exists('directory_name', $response)){
                    return redirect()->route('mail.admin.index')->with('error','Directory Name is not allowed!');
                } else{
                    return redirect()->route('mail.admin.index')->with('error', 'Something went wrong!.');
                }
            }catch (\Exception $exception){
                return redirect()->route('mail.admin.index')->with('error', 'Something went wrong!.');
            }
        }else{
            abort(403,'You do not have access to this action!');
        }

    }

    public function delete(MailboxDeleteRequest $request, DeleteBulkMailboxInterface $interface)
    {
        if (!auth()->guard('web')->user()->hasRole('Company User') && auth()->guard('web')->user()->can('delete.mailbox')) {
            try {
    //            (new MailboxDestroyAction())->execute($request->validated());
               $interface->execute($request->validated());
                if(\auth()->user()->hasRole('Company User')){
                    return redirect()->route('mail.index')->with('success', 'Mail(s) Deleted Successfully');
                }
                return redirect()->route('mail.admin.index')->with('success', 'Mail(s) Deleted Successfully');
            }catch (\Exception $exception){
                return redirect()->route('mail.admin.index')->with('error', 'Something went wrong!');
            }
        }else{
            abort(403,'You do not have access to this action!');
        }

    }

    public function deleteIndividual($mail, DeleteIndividualMailboxInterface $interface)
    {
        if (!auth()->guard('web')->user()->hasRole('Company User') && auth()->guard('web')->user()->can('delete.mailbox')) {
            try {
                $interface->execute(['mail' => $mail]);
                return ['status' => true, 'msg' => 'Mail Deleted Successfully'];
            }catch (\Exception $exception){
                throw new \Exception($exception->getMessage());
            }
        }else{
            abort(403,'You do not have access to this action!');
        }
    }

//    Filter by company only

//    public function getMail($id)
//    {
//        $mails=(new MailboxGetMailByCompanyAction())->execute($id,'DESC',2);
//        return $mails;
//    }
    public function getMailByPriority(Request $request,$priority, GetMailByPriorityInterface $interface)
    {
        $mails=$interface->execute($request,$priority,'DESC', config('paginate.page_count'));

        return $mails;
    }
    public function getAdminMailByPriority(Request $request,$priority, GetAdminMailByPriorityInterface $interface)
    {
        $mails=$interface->execute($request,$priority,'DESC',config('paginate.page_count'));
        return $mails;
    }
    public function getMailByCategory(Request $request,$category, GetMailByCategoryInterface $interface)
    {
        try {
            $mails=$interface->execute($request,$category,'DESC',config('paginate.page_count'));
            return $mails;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
    public function getAdminMailByCategory(Request $request,$category, GetAdminMailByCategoryInterface $interface)
    {
        try {
            $mails=$interface->execute($request,$category,'DESC',config('paginate.page_count'));
            return $mails;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }

    public function searchMail(Request $request,$search,SearchMailboxInterface $interface)
    {
        $mails=$interface->execute($request,$search,'DESC',config('paginate.page_count'));
        return \response()->json($mails);
    }
    public function customerSearchMail(Request $request,$search,SearchCustomerMailboxInterface $interface)
    {

        $mails=$interface->execute($request,$search,'DESC',config('paginate.page_count'));
        return \response()->json($mails);
    }


    public function downloadAttachment(DownloadMailRequest $request)
    {
        try {
            $response = (new MailboxDownloadAction())->execute($validatedData=$request->validated());

            if (key_exists('zipName', $response)){
                (new MailboxUpdateAction())->execute($request['mail-id']);
            }elseif (key_exists('empty', $response)){
                return view('mailbox.fileNotFound');
            }
            return response()->download(public_path($response["zipName"]))->deleteFileAfterSend(true);

        }catch (\Exception $exception){
//            return $exception->getMessage();
            return view('mailbox.fileNotFound');
        }
    }

    public function individualDownload($id)
    {
        try {
            $explodedResponse=array();
            $response= (new MailboxIndividualDownloadAction())->execute($id);
            if (key_exists('zipName', $response) || key_exists('pathToFile', $response)){
                (new MailboxUpdateAction())->execute($id);
            }
            if (key_exists('zipName', $response)){
                $explodedResponse=explode('.',$response['zipName']);
            }elseif(key_exists('pathToFile', $response)){
                $explodedResponse=explode('.',$response['pathToFile']);
            }

            if(strtolower($explodedResponse[count($explodedResponse) - 1]) =='zip'){
                return response()->download(public_path($response['zipName']))->deleteFileAfterSend(true);
            }
            return response()->download($response['pathToFile']);
        }catch (\Exception $exception){
            return view('documentManagement.admin.requestFailed');
        }
    }

    public function markAsDownloaded($id)
    {

        $response = (new MailboxMarkAsDownloadedAction())->execute($id);
        return $response;
    }

    public function getDirectories($company_id,$category)
    {
        try {
            $company_root_dir ='mailbox/company_'. $company_id.'/'.$category;
            return Storage::disk('public')->directories($company_root_dir);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
    public function getCompanyDirectories($company_id)
    {
        try {
            $directories  =[];
            $categories = ['Mailbox','Corporate Secretary','Tax', 'Accounting', 'Human Resource'];
            $company_root_dir ='mailbox/company_'. $company_id;
            foreach($categories as $category){
                array_push($directories, Storage::disk('public')->directories($company_root_dir.'/'. $category) );
            }
            return $directories;
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function renameFolder(RenameMailboxDirectoryRequest $request)
    {
        try {
            $response = (new MailboxRenameDirectoryAction())->execute($request->validated());
            return ['status' => true, 'msg' => 'Directory has been renamed successfully '];
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function deleteDirectory($company_root_directory,$category, $directory)
    {
       if(count(Storage::disk('public')->allFiles('mailbox/'. $company_root_directory.'/'.$category.'/'. $directory)) == 0){
           Storage::disk('public')->deleteDirectory('mailbox/'. $company_root_directory.'/'.$category.'/'. $directory);
           return ['status' => true, 'msg'=> 'Directory Deleted Successfully'];
       }else{
           return ['status' => false, 'msg' => "Oops! The Folder is not empty"];
       }
    }
}
