<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentManagement extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=['id'];
//    protected $dates=['updated_at'];

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function signers()
    {
        return $this->belongsToMany(CompanyManagement::class,'document_signers', 'document_id','user_id')
            ->withPivot('user_type')
            ->withTimestamps();

    }

    public function getUpdatedAtAttribute($updated_at){
        return Carbon::parse($updated_at)->tz('Asia/Singapore')->format('d M Y H:i');
    }

}
