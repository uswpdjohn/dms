<?php

namespace App\Actions\ESOP;

use App\Models\ESOP;

class ESOPListAction
{
    public function execute($count,$search=null)
    {
        $data = ESOP::with(['member', 'company'])->companyId();

        if ($search != NULL) {
            $data = $data->WhereHas('member', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('company', function ($query) use ($search){
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        $data = $data->orderBy('created_at','DESC')->paginate($count)->appends(array('search' => $search));
        return $data;
    }
}
