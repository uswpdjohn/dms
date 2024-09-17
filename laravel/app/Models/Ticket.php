<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=['id', 'slug'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $last_id = static::orderBy('id', 'desc')->first()->id ?? 0;
//            $model->ticket_no = str_pad( (int) 00000 + $last_id + 1 ,STR_PAD_LEFT);
            $model->ticket_no =  str_pad($last_id+1, 5, '0', STR_PAD_LEFT);

            $slug = Str::slug($model->ticket_no);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
        static::updating(function($model) {
            $slug = Str::slug($model->ticket_no);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }

    public function categories(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
    public function companies(){
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
    public function users(){
        return $this->hasOne(User::class, 'id', 'issuer_id');
    }
}

