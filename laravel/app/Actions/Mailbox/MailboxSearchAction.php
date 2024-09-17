<?php

namespace App\Actions\Mailbox;

use App\Interfaces\Mailbox\SearchMailboxInterface;
use App\Models\Company;
use App\Models\Mailbox;

class MailboxSearchAction implements SearchMailboxInterface
{
    public static function execute($request,$search,$orderBy,$count)
    {
        try {
//            var_dump('in');
//            die();
//        return $request;
//        dd($request);
            $data=Mailbox::query();
            $companies=Company::where('name', 'LIKE', "%$search%")->get();
            $companyId=[];
            if (count($companies) > 0){
                foreach ($companies as $company){
                    array_push($companyId, $company->id);
                }
                if(!empty($companyId)){
                    if ($request->category != 'all'){
                        if ($request->priority != 'all'){
                            $data= $data->with('companies')->whereHas('companies')
                                ->WhereIn('company_id',($companyId))
                                ->where('category', $request->category)
                                ->where('priority', $request->priority);
                        }else{
                            $data= $data->with('companies')->whereHas('companies')->WhereIn('company_id',($companyId))->where('category', $request->category);
                        }
                    }else{
                        if ($request->priority != 'all') {
                            $data = $data->with('companies')->whereHas('companies')->WhereIn('company_id', ($companyId))->where('priority', $request->priority);
                        }
                    }
                    $data = $data->with('companies')->whereHas('companies')
                        ->WhereIn('company_id',($companyId));
//                $mails= Mailbox::with('companies')->WhereIn('company_id',($companyId))
//                    ->orderBy('created_at', $orderBy)
//                    ->paginate($count);
//                return $mails;
                }
            }else{
                if ($request->category != 'all'){

                    if ($request->priority != 'all'){
//                        var_dump('in2');
//                        die();
                        $data= $data->with('companies')->whereHas('companies')->where('category', $request->category)->where('priority', $request->priority)->where('title','LIKE', "%$search%");
//                            ->orWhere('from','LIKE', "%$search%");
                    }else{
                        $data= $data->with('companies')->whereHas('companies')->where('category', $request->category)->where('title','LIKE', "%$search%");
//                            ->orWhere('from','LIKE', "%$search%");
                    }
                }else{
                    if ($request->priority != 'all') {
                        $data = $data->with('companies')->whereHas('companies')->where('priority', $request->priority)->where('title','LIKE', "%$search%");
//                            ->orWhere('from','LIKE', "%$search%");
                    }else{
                        $data = $data->with('companies')->whereHas('companies')->where('title','LIKE', "%$search%");
//                            ->orWhere('from','LIKE', "%$search%");
                    }
                }
            }
            $data= $data->with('companies')->whereHas('companies')
                ->orderBy('created_at', $orderBy)
                ->paginate($count);
            $response=$data;
        }catch (\Exception $exception){
            $response = $exception->getMessage();
        }
        return $response;

    }

}
