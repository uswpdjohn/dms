<?php


namespace App\Actions\FAQ;


use App\Models\FAQ;
use Illuminate\Support\Facades\DB;

class FAQShowAction
{
    public function execute($id)
    {
        try {
            $data = FAQ::findOrFail($id);
            $response = $data;
        }catch (\Exception $exception){
            $response = $exception->getMessage();
        }
        return $response;
    }
}
