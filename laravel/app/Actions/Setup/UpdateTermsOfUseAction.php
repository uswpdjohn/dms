<?php

namespace App\Actions\Setup;

class UpdateTermsOfUseAction
{
    public function execute($validatedData,$setup)
    {
        $setup->value = $validatedData['terms_of_use'];
        $setup->save();
        return $setup;
    }

}
