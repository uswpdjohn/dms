<?php
namespace App\Helpers;
use App\Mail\SendMail;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Exception;
use PHPUnit\Framework\Error;

class MailHelper extends Mailable {
    use Queueable, SerializesModels;
    protected $details;

    function __construct($details)
    {
        $this->details= $details;
    }

    function sendMail(){

        Mail::to($this->details['to'])->send(new SendMail($this->details));
//        try {
////            var_dump($this->details);die();
//        }catch (\Exception $exception){
////            logger('logging-'.$exception->getMessage());
//            print_r('logging-'.$exception->getMessage());
//
//        }


//        $this->subject($this->details['subject'])->view('email.email_template')->with('details',$this->details);
//        try {
//            print_r("Mail sending \n");
//            Mail::to($this->details['to'])->send(new SendMail($this->details));
//            print_r('Mail Sending complete');
//        }
//        catch (\Exception $exception) {
//            logger('Mail sending exception');
//            logger($exception->getMessage());
//            logger('Mail sending exception end');
//        }
    }
}
