<?php

namespace App\Actions\Setup;

use App\Models\Setup;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ChangeLoginImageAction
{
    public function execute($validatedData,$setup)
    {
        DB::beginTransaction();
        try {
//            dd($validatedData['login_bg_image']);
            $filename= $validatedData['login_bg_image']->getClientOriginalName();
            $contents = file_get_contents($validatedData['login_bg_image']);
            file_put_contents(public_path('/assets/images/'.$filename),$contents); //put the content in local storage
            if ($setup->value != null){
                unlink(public_path("assets/images/".$setup->value));
            }

            $setup->value = $filename;
            $setup->save();
            DB::commit();
            return $setup;

        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }

    }

}
