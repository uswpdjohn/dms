<?php

namespace App\Actions\User;

use App\Helpers\MailHelper;
use App\Models\User;
use PHPUnit\Exception;

class UserRequestSignUpAction
{
    public function execute($validatedData)
    {
        try {
//            $users= User::role('Admin')->get();
            $user= User::role('Super Admin')->first();
//            $body = "{$validatedData['first_name']} {$validatedData['last_name']} requested for opening a new account.  First Name: {$validatedData['first_name']}  Last Name: {$validatedData['last_name']} \n Email: {$validatedData['email']} \n Notes: {$validatedData['notes']}";
            $details = [
                'purpose' => 'request for signup',
                'subject' => "Requesting for Sign up",
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'notes' => $validatedData['notes'],
                'to' => str_replace("\n", "", $user->email)
            ];
            try {
                $mail = new MailHelper($details);
                $mail->sendMail();
            }catch (\Exception $exception){
                return array(
                    'send_mail'=> false
                );
            }

            return array('success' => true);

        }catch (Exception $exception){
//            abort(403, $exception->getMessage());
            return $exception->getMessage();
        }

//        foreach ($users as $user){
////                dd($user->email);
//            $body = "{$validatedData['first_name']} {$validatedData['last_name']} requested for opening a new account.  First Name: {$validatedData['first_name']}  Last Name: {$validatedData['last_name']} \n Email: {$validatedData['email']} \n Notes: {$validatedData['notes']}";
//            $details = [
//                'subject' => "Requesting for Sign up",
//                'body' => $body,
//                'to' => str_replace("\n", "", $user->email)
//            ];
//            $mail = new MailHelper($details);
//            $mail->sendMail();
//        }

    }

}
