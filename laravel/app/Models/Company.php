<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=['id', 'slug'];
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $slug = Str::slug($model->name);
            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $model->slug = $count ? "{$slug}-{$count}" : $slug;
        });
        /**
         * ESOP Reserve member in Company Member table for Cap Table module
         * */
        static::created(function ($model){
            $model->companyMembers()->create(['name' => 'ESOP Reserve']);
        });

        /**
         * Making directory for each company
         */
        static::created(function ($model){
            $directory_name = 'company_'.$model->id;
            $categories = ['Mailbox', 'Corporate Secretary', 'Tax', 'Accounting', 'Human Resource'];
            foreach ($categories as $category){
                if(!Storage::disk('public')->exists('mailbox/'.$directory_name.'/'. $category)){
                    Storage::disk('public')->makeDirectory('mailbox/'.$directory_name.'/'. $category);
                }
            }
        });
        static::deleted(function ($model){
            $model->companyMembers()->delete();
            $model->activityEntries()->delete();
        });
//        static::updating(function($model) {
//            $slug = Str::slug($model->name);
//            $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
//            $model->slug = $count ? "{$slug}-{$count}" : $slug;
//        });
    }
//    protected $casts = [
//        'location' => 'array'
//    ];
    public function companyServices(){
        return $this->hasMany(CompanyServices::class, 'company_id', 'id')
            ->whereDate('next_renewal', '>=', now())
            ->orderBy('subscription_start');
    }

    public function companyMembers()
    {
        return $this->hasMany(CompanyMember::class, 'company_id');
    }

    public function activityEntries()
    {
        return $this->hasMany(CapTableActivity::class);
    }


    public function company_users()
    {
            return $this->belongsToMany(CompanyManagement::class,'company_users', 'company_id','user_id')
                ->where("company_users.user_type",'!=','user')
                ->withPivot("user_type")
                ->withTimestamps();

    }
    public function directors()
    {
        return $this->belongsToMany(CompanyManagement::class,'company_users', 'company_id','user_id')
            ->where("company_users.user_type",'=','director')
            ->withPivot("user_type")
            ->withTimestamps();
    }
    public function shareholders()
    {
        return $this->belongsToMany(CompanyManagement::class,'company_users', 'company_id','user_id')
            ->where("company_users.user_type",'=','shareholder')
            ->withPivot("user_type")
            ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'company_users', 'company_id','user_id')
            ->where("company_users.user_type",'=','user')
            ->withPivot("user_type")
            ->withTimestamps();
    }
    public function primary_industry_service_ssic()
    {
        return $this->belongsTo(SSIC::class, 'primary_industry_service_ssic_id', 'id');
    }
    public function secondary_industry_service_ssic()
    {
        return $this->belongsTo(SSIC::class, 'secondary_industry_service_ssic_id', 'id');
    }
    public function documents()
    {
        return $this->hasMany(DocumentManagement::class);
    }
//    public function invoices()
//    {
//        return $this->hasMany(Invoice::class);
//    }

    public function shareCertificates()
    {
        return $this->hasMany(ShareCertificate::class, 'id', 'share_certificate_id');
    }


//    public function getIncorporationDateAttribute($value) {
//        return \Carbon\Carbon::parse($value)->format('d M Y');
//    }

//    public function getLocationAttribute($value)
//    {
//        return json_decode(json_decode($value,true));
//    }

}
