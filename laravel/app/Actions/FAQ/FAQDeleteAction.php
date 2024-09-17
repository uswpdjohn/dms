<?php


namespace App\Actions\FAQ;


use App\Models\FAQ;
use Illuminate\Support\Facades\DB;

class FAQDeleteAction
{
    public function execute($id)
    {
        DB::beginTransaction();
        try {
            $data = FAQ::findOrFail($id);
            $data->delete($id);
            DB::commit();
            $response = $data;

        }catch (\Exception $exception){
            DB::rollBack();
            $response = $exception->getMessage();
        }
        return $response;
    }
}
