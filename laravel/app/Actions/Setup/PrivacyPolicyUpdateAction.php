<?php

namespace App\Actions\Setup;

class PrivacyPolicyUpdateAction
{
    public function execute($validatedData,$setup)
    {
        $setup->value = $validatedData['privacy_policy'];
        $setup->save();
        return $setup;
    }

}
