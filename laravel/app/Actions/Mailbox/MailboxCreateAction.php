<?php

namespace App\Actions\Mailbox;

use App\Helpers\Helper;
use App\Helpers\MailHelper;
use App\Interfaces\Mailbox\StoreMailboxInterface;
use App\Jobs\SendMailToCompanyUser;
use App\Models\Company;
use App\Models\Mailbox;
use App\Models\User;
use App\Notifications\MailboxNotification;
use App\Notifications\TicketAdminNotification;
use App\Notifications\TicketNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use MongoDB\Driver\Session;
use PHPUnit\Exception;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\Console\Input\Input;
use ZipArchive;

class MailboxCreateAction implements StoreMailboxInterface
{
    public static function execute($validatedData)
    {


        DB::beginTransaction();
        try {
            if (request()->hasFile('file')) {
                $directory = $validatedData['directory'];
                $category=   Helper::convertToTitleCase($validatedData['category']);
                /**
                 * check if directory has any sub-directory
                 */
                $directory_explode = explode('/', $directory);
                if(count($directory_explode)>1){
                    return ['directory_name' => false];
                }
                $path = 'company_'.$validatedData['company_id'].'/'.$category.'/' .$directory;
                if(!Storage::disk('public')->exists('mailbox/'.$path)){
                    Storage::disk('public')->makeDirectory('mailbox/'.$path);
                }

                $validatedData['file']=request()->file->getClientOriginalName();
                $fileArr=explode(".",$validatedData['file']);
                $dir_name= $fileArr[count($fileArr)-2];
                if (strtolower($fileArr[count($fileArr)-1]) == 'zip') {
                    try {
                        $dir = __DIR__ . '/uploaded';
                        $zip = new ZipArchive();
                        if ($zip->open(request()->file->getPathName()) === true) {
                            $zip->extractTo($dir);
                            $file=scandir($dir);
                            try {
                                if (count($file) >= 3){
                                    // checking if zip without sub folder
                                    if (count(explode('.',$file[2]))>1){
//                                        $new_dir=mkdir(storage_path("app/public/mailbox/". $dir_name));
//                                        $zip->extractTo(storage_path("app/public/mailbox/". $dir_name));
                                        $zip->extractTo(storage_path("app/public/mailbox/".$path .'/'.$dir_name));
                                    }else{
                                        //minimum 1 sub folder
                                        //using basename function to get filename without extension
                                        if(implode(explode('.',$file[2])) == basename(request()->file->getClientOriginalName(), '.'.request()->file->getClientOriginalExtension())){
                                            $zip->extractTo(storage_path("app/public/mailbox/".$path.'/'));
                                        }else{
                                            \Illuminate\Support\Facades\Session::flash('error', 'ZIP Directory Name mismatched!');
                                        }
                                    }

                                }
                            }catch (\Exception $exception){
//                                throw new \Exception("Something Went Wrong!");
                                throw new \Exception('ex:',$exception->getMessage());
                            }
                            $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
                            $files = new RecursiveIteratorIterator($it,
                                RecursiveIteratorIterator::CHILD_FIRST);
                            foreach($files as $file) {
                                if ($file->isDir()){
                                    rmdir($file->getRealPath());
                                } else {
                                    unlink($file->getRealPath());
                                }
                            }
                            rmdir($dir);
                            $zip->close();
//                            $create_mail = Mailbox::create($validatedData);
                            $create_mail = new Mailbox();
                            $create_mail->from=$validatedData['from'];
                            $create_mail->category=$validatedData['category'];
                            if (!empty($validatedData['title'])){
                                $create_mail->title=$validatedData['title'];
                            }
                            $create_mail->company_id = $validatedData['company_id'];
                            if (!empty($validatedData['priority'])){
                                $create_mail->priority = $validatedData['priority'];
                            }
                            $fileName = $validatedData['file'];
                            $create_mail->file = $fileName;
                            $create_mail->directory = $directory;
                            $create_mail->save();

                            /**
                             * Send e-mail notification
                             * */
//                            try {
//                                SendMailToCompanyUser::dispatch($validatedData['company_id'],$validatedData['from'],$validatedData['title'],$validatedData['category']);
//                            }catch (\Exception $exception){
//                                $this->deleteDirectoryOnFailure($validatedData['directory'],$validatedData['category'],$validatedData['company_id']);
//                                return ['send_mail' => false];
//                            }

//                            $this->notifyAdminUsers($create_mail);
//                            $this->notifyCompanyUsers($validatedData['company_id'], $create_mail);




                            DB::commit();
                            return ['success' => true];
                        }
                    }catch (\Exception $exception){
//                        throw new \Exception("Something Went Wrong!");
                        throw new \Exception($exception->getMessage());
                    }
                }else{
                    $mailbox = new Mailbox();
                    $mailbox->from=$validatedData['from'];
                    $mailbox->category=$validatedData['category'];
                    if (!empty($validatedData['title'])){
                        $mailbox->title=$validatedData['title'];
                    }
                    $mailbox->company_id = $validatedData['company_id'];
                    if (!empty($validatedData['priority'])){
                        $mailbox->priority = $validatedData['priority'];
                    }
                    $fileName = time() . '-' . $validatedData['file'];
                    request()->file->storeAs('public/mailbox/'.$path.'/', $fileName);
                    $mailbox->file = $fileName;
                    $mailbox->directory = $directory;
                    $mailbox->save();

//                    $this->notifyAdminUsers($mailbox);
//                    $this->notifyCompanyUsers($validatedData['company_id'],$mailbox);


                    /**
                     * Send email notification
                     */
//                    try {
//                        SendMailToCompanyUser::dispatch($validatedData['company_id'],$validatedData['from'],$validatedData['title'],$validatedData['category']);
//                    }catch (\Exception $exception){
//                        $this->deleteDirectoryOnFailure($validatedData['directory'],$validatedData['category'],$validatedData['company_id']);
//                        return ['send_mail' => false];
//                    }
                    DB::commit();
                    return ['success' => true];
                }
            }else{
                $mailbox = Mailbox::create($validatedData);

//                $this->notifyAdminUsers($mailbox);
//                $this->notifyCompanyUsers($validatedData['company_id'],$mailbox);

                //send mail
//                try {
//                    SendMailToCompanyUser::dispatch($validatedData['company_id'],$validatedData['from'],$validatedData['title'],$validatedData['category']);
//                }catch (\Exception $exception){
//                    $this->deleteDirectoryOnFailure($validatedData['directory'],$validatedData['category'],$validatedData['company_id']);
//                    return ['send_mail' => false];
//                }
                DB::commit();
                return ['success' => true];
            }
        }catch (\Exception $exception){
            DB::rollBack();
            self::deleteDirectoryOnFailure($validatedData['directory'],$validatedData['category'],$validatedData['company_id']);
            return $exception->getMessage();
        }
    }

    protected function notifyAdminUsers($mailbox){
        $adminUsers = User::role('Admin')->get();
        if(count($adminUsers)>0) {
            foreach ($adminUsers as $user) {
                $user->notify(new MailboxNotification($mailbox));
            }
        }
    }

    protected static function notifyCompanyUsers($company_id,$mailbox){
        $company = Company::with('users')->where('id', $company_id)->first();
        $users=$company->users;
        if(count($users)>0) {
            foreach ($users as $user) {
                $user->notify(new MailboxNotification($mailbox));
            }
        }
    }

    protected static function deleteDirectoryOnFailure($directory,$category,$company_id)
    {
        $category=   Helper::convertToTitleCase($category);
        $path = 'company_'.$company_id.'/'.$category.'/' .$directory;
        if(Storage::disk('public')->exists('mailbox/'.$path)){
            Storage::disk('public')->deleteDirectory('mailbox/'.$path);
        }

    }

}
