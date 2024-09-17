<?php

namespace App\Models;

use Database\Factories\CompanyMemberFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CompanyMember extends Model
{
    use HasFactory, SoftDeletes;

//    protected $fillable = ['name', 'company_id'];
    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return CompanyMemberFactory::new();
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

//    public function capTableActivity()
//    {
//        return $this->hasMany(CapTableActivity::class);
//    }


    //using
//    public function capTableSum()
//    {
//        $shareTypes = ShareType::pluck('share_type')->toArray(); // Assuming ShareType is your model for share_types table
//
//        return $this->hasMany(CapTableActivity::class, 'company_member_id')
//            ->crossJoin('share_types')
//            ->selectRaw('company_member_id, share_types.share_type, COALESCE(SUM(CASE WHEN cap_table_activities.share_type = share_types.share_type THEN cap_table_activities.share_number ELSE 0 END), 0) as sum_of_share_number')
//            ->groupBy('company_member_id', 'share_types.share_type');
//    }


//    public function capTableTotalShareSum()
//    {
//        return $this->hasMany(CapTableActivity::class, 'company_member_id')
//            ->selectRaw('company_member_id,sum(share_number) as sum_of_total_share_number')
//            ->groupBy('company_member_id');
//    }


//    public function shareCertificates()
//    {
//        return $this->hasMany(ShareCertificate::class);
//    }


//    public function esopEntry()
//    {
//        return $this->hasMany(ESOP::class);
//    }

}
