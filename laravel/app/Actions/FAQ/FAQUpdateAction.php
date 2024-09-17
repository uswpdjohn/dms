<?php


namespace App\Actions\FAQ;


use App\Models\FAQ;
use Illuminate\Support\Facades\DB;

class FAQUpdateAction
{
    public function execute($validatedData, $id)
    {
        DB::beginTransaction();
        try {
            $data = FAQ::findOrFail($id);
            $data->update($validatedData);
            DB::commit();
            $response = $data;

        }catch (\Exception $exception){
            DB::rollBack();
            $response = $exception->getMessage();
        }
        return $response;
    }
}
