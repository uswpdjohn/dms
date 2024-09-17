<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Mailbox extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=['id','slug'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $slug = Str::slug($model->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
        static::updating(function($model) {
            $slug = Str::slug($model->title);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
    public function companies(){
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function getUpdatedAtAttribute($updated_at){
        return Carbon::parse($updated_at)->tz('Asia/Singapore')->format('d M Y H:i');
    }

}
