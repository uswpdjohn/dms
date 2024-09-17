<?php


namespace App\Actions\FAQ;


use App\Models\FAQ;
use Illuminate\Support\Facades\DB;

class FAQCreateAction
{
    public function execute($validatedData)
    {
        DB::beginTransaction();
        try {
            $result = FAQ::create($validatedData);
            DB::commit();
            $response = $result;

        }catch (\Exception $exception){
            DB::rollBack();
            $response = $exception->getMessage();
        }
        return $response;
    }
}
