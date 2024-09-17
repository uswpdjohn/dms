<?php

namespace App\Actions\CapTable;

use App\Helpers\CapTableCompanyHelper;
use App\Models\CapTableActivity;

class CapTableActivityEntriesListAction
{
    public function execute($search,$count)
    {
        $data = CapTableActivity::with(['member', 'transferMember'])->where('company_id', CapTableCompanyHelper::get());
        if ($search != NULL) {
            $data = $data->WhereHas('member', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('transferMember', function ($query) use ($search){
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        $data = $data->orderBy('created_at','DESC')->paginate($count)->appends(array('search' => $search));
        return $data;
    }
}
