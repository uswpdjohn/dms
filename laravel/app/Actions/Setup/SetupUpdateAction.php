<?php

namespace App\Actions\Setup;

use App\Models\Setup;
use http\Exception\UnexpectedValueException;

class SetupUpdateAction
{
    public function execute($validatedData,$key)
    {
        $setup = Setup::where('key', $key)->first();

        if (!$setup){
            throw new \Exception('Key Not Found');
        }

        if (request()->hasFile('login_bg_image')) {
            return (new ChangeLoginImageAction())->execute($validatedData,$setup);
        }

        if (key_exists('terms_of_use', $validatedData)) {
            return (new UpdateTermsOfUseAction())->execute($validatedData,$setup);
        }
        if(key_exists('privacy_policy',$validatedData)){
            return (new PrivacyPolicyUpdateAction())->execute($validatedData,$setup);
        }

    }

}
