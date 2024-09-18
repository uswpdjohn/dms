<?php

namespace App\Jobs;

use App\Helpers\MailHelper;
use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailToCompanyUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $company_id,$from,$title,$folder;

    public function __construct($company_id,$from,$title,$folder)
    {
        $this->company_id = $company_id;
        $this->from = $from;
        $this->title = $title;
        $this->folder = $folder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //send email to company user
        $company = Company::with('users')->where('id', $this->company_id)->first();

        //convert snake case category name to pascal case
//        $mail_category = preg_replace_callback("/(?:^|_)([a-z])/", function($matches) {
//            return strtoupper($matches[1]);
//        }, $this->category);

        foreach ($company->users as $company_user ){
            $details = [
                'subject' => 'USW-MSC | New Mail Received',
                'from' => $this->from,
                'title' => $this->title,
                'folder' => $this->folder,
                'to' => $company_user->email,
                'purpose' => 'send mail on mailbox create',
            ];
            $mail = new MailHelper($details);
            $mail->sendMail();
        }

    }
}
