<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $casts =['slug'=>'string'];

    public function recipients()
    {
        return $this->hasMany(Recipient::class, 'category_id', 'id');
    }

    public function faqs()
    {
        return $this->hasMany(FAQ::class);
    }
}
