<?php

namespace App\Actions\Ticket;


use App\Helpers\Helper;
use App\Helpers\MailHelper;
use App\Interfaces\Ticket\StoreTicketInterface;
use App\Models\Category;
use App\Models\Recipient;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketAdminNotification;
use App\Notifications\TicketNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class TicketCreateAction implements StoreTicketInterface
{
    public static function execute($validatedData){
        DB::beginTransaction();
        try {
            $ticket = new Ticket();
            $ticket->message = $validatedData['message'];
            $ticket->status = 'open';
            $ticket->issuer_id = Auth::guard('web')->user()->id;
            $ticket->category_id = $validatedData['category_id'];
            $ticket->company_id = Helper::auth_user_company();

            if (request()->hasFile('file')) {
                $file=$validatedData['file'];
                $fileName = time() . '.' . $file->getClientOriginalName();
                $file->storeAs('public/ticket', $fileName);
                $ticket->file = $fileName;
            }
            $ticket->save();
//            $recipients=Recipient::where('category_id',$validatedData['category_id'])->get();
//            $issuer = Auth::guard('web')->user()->getFullNameAttribute() .'('.Auth::guard('web')->user()->email .')' ;
//            $category = Category::where('id', $validatedData['category_id'])->first();
//            foreach ($recipients as $recipient){
//                $details = [
//                    'purpose' => 'ticket submitted',
//                    'subject' => 'Gateway of Asia|New Ticket Submitted',
//                    'issuer' => $issuer,
//                    'category' => $category->name,
//                    'message' => $validatedData['message'],
//                    'to' => $recipient->email,
//                ];
//                try {
//                    $mail = new MailHelper($details);
//                    $mail->sendMail();
//                }catch (\Exception $exception){
//                    return array(
//                        'send_mail'=> false
//                    );
//                }
//            }

            auth()->user()->notify(new TicketNotification($ticket));
            $users = User::role('Company Owner')->get();
            foreach ($users as $user){
                $user->notify(new TicketAdminNotification($ticket));
            }
            DB::commit();
            return array('success'=>true);
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }


    }
}
