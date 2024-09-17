<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id','slug'];
//    public static function boot()
//    {
//        parent::boot();
//        static::creating(function ($model){
//            $slug = Str::slug($model->name);
//            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
//            $model->slug = $count ? "{$slug}-{$count}" : $slug;
//        });
//        //slug updating not implemented because role slug changing when updating any other field data
//
//    }
}
