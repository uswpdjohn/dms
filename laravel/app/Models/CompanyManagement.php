<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CompanyManagement extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'company_management';
    protected $guarded = ['id','slug'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $slug = Str::slug($model->first_name.' '. $model->last_name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
//        static::updating(function($model) {
//            $slug = Str::slug($model->first_name.' '. $model->last_name);
//            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
//            $model->slug = $count ? "{$slug}-{$count}" : $slug;
//        });
    }
    protected $casts = [
        'ccs' => 'array'
    ];
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function getCcsAttribute($value)
    {
        return json_decode($value,true);
    }
    public function setCcsAttribute($value)
    {

        $this->attributes['ccs'] = json_encode($value);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
