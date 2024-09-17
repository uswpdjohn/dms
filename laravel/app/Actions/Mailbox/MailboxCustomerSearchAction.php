<?php

namespace App\Actions\Mailbox;

use App\Interfaces\Mailbox\SearchCustomerMailboxInterface;
use App\Models\Company;
use App\Models\Mailbox;

class MailboxCustomerSearchAction implements SearchCustomerMailboxInterface
{
    public static function execute($request,$search,$orderBy,$count)
    {
        try {
            $data=Mailbox::query();
            if ($request['category'] != 'all'){
                if ($request['priority'] != 'all'){
                    $data= $data->where('company_id', \session()->get('auth_user_company')->id ?? '')
                        ->where('category', $request['category'])
                        ->where('priority', $request['priority']);

                }else{
                    $data= $data->where('company_id', \session()->get('auth_user_company')->id ?? '')
                        ->where('category', $request['category']);
                }
            }else{
                if ($request['priority'] != 'all') {
                    $data = $data->where('company_id', \session()->get('auth_user_company')->id ?? '')
                        ->where('priority', $request['priority']);
                }else{
                    $data = $data->where('company_id', \session()->get('auth_user_company')->id ?? '');
                }
            }
            $data= $data->where('company_id', \session()->get('auth_user_company')->id ?? '')
                ->where('title','LIKE', "%$search%")
                ->orderBy('created_at', $orderBy)
                ->paginate($count);
            $response=$data;
        }catch (\Exception $exception){
            $response = $exception->getMessage();
        }
        return $response;
    }

}
