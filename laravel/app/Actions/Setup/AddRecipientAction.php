<?php

namespace App\Actions\Setup;

use App\Models\Category;
use App\Models\Recipient;

class AddRecipientAction
{
    public function execute($validatedData)
    {
        $category= Category::findOrFail($validatedData['category_id']);

        return Recipient::create($validatedData);
    }

}
