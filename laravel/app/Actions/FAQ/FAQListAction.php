<?php


namespace App\Actions\FAQ;


use App\Models\FAQ;

class FAQListAction
{
    public function execute($filter, $category_id, $count)
    {
        try {
            $data = FAQ::query();
            if($category_id){
                if ($category_id !=0){
                    $data = $data->whereHas('category', function($query) use ($category_id){
                        $query->where('id', $category_id);
                    });
                }else{
                    $data = $data->whereHas('category', function($query) use ($category_id){
                        $query->all();
                    });
                }

            }
            if ($filter) {
                $data = $data->where('question', 'like', '%' . $filter . '%');
//                    ->orWhere('answer', 'like', '%' . $filter . '%');
            }

            $data = $data->with('category')->paginate($count)->appends(array('category_id'=>$category_id,'search'=>$filter));
            $response = $data;
        } catch (\Exception $exception) {
            $response = $exception->getMessage();
        }
        return $response;
    }
}
