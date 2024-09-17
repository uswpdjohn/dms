<?php

namespace Database\Seeders;

use App\Actions\Company\CompanyCreateAction;
use App\Actions\Company\CompanyServicesCreateAction;
use App\Models\Company;
use App\Models\CompanyManagement;
use App\Models\CompanyServices;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();
        $companies = [
            [
                'name'=> 'Trillion Training Group Pte Ltd',
                'uen'=>'201575351A',
                'fye'=>Carbon::createFromFormat('Y-m-d', '2023-12-31'),
                'gst_reg_no'=>'201923233T',
                'incorporation_date'=> Carbon::createFromFormat('Y-m-d', '2007-01-11'),
                'company_age'=> '15',
                'no_of_employees'=>'Medium Enterprise (50 - 249)',
                'no_of_offices'=>'50',
                'primary_industry_service_ssic_id'=>1,
                'secondary_industry_service_ssic_id'=>2,
                'address_line'=>"12 East st, Ave 3",
                'status'=>'active',
                'created_by'=> 1,
            ],
            [
                'name'=> 'Company One Pte Ltd',
                'uen'=>'201575351A',
                'fye'=>Carbon::createFromFormat('Y-m-d', '2023-12-31'),
                'gst_reg_no'=>'201923233T',
                'incorporation_date'=> Carbon::createFromFormat('Y-m-d', '2007-01-11'),
                'company_age'=> '15',
                'no_of_employees'=>'Medium Enterprise (50 - 249)',
                'no_of_offices'=>'50',
                'primary_industry_service_ssic_id'=>1,
                'secondary_industry_service_ssic_id'=>2,
                'address_line'=>"12 East st, Ave 3",
                'status'=>'active',
                'created_by'=> 5,
            ],
            [
                'name'=> 'Company Two Pte Ltd',
                'uen'=>'201575351A',
                'fye'=>Carbon::createFromFormat('Y-m-d', '2023-12-31'),
                'gst_reg_no'=>'201923233T',
                'incorporation_date'=> Carbon::createFromFormat('Y-m-d', '2007-01-11'),
                'company_age'=> '15',
                'no_of_employees'=>'Medium Enterprise (50 - 249)',
                'no_of_offices'=>'50',
                'primary_industry_service_ssic_id'=>1,
                'secondary_industry_service_ssic_id'=>2,
                'address_line'=>"12 East st, Ave 3",
                'status'=>'active',
                'created_by'=> 5,
            ],
            [
                'name'=> 'Company Three Pte Ltd',
                'uen'=>'201575351A',
                'fye'=>Carbon::createFromFormat('Y-m-d', '2023-12-31'),
                'gst_reg_no'=>'201923233T',
                'incorporation_date'=> Carbon::createFromFormat('Y-m-d', '2007-01-11'),
                'company_age'=> '15',
                'no_of_employees'=>'Medium Enterprise (50 - 249)',
                'no_of_offices'=>'50',
                'primary_industry_service_ssic_id'=>1,
                'secondary_industry_service_ssic_id'=>2,
                'address_line'=>"12 East st, Ave 3",
                'status'=>'active',
                'created_by'=> 5,
            ],
            [
                'name'=> 'The Digital Gadgets',
                'uen'=>'201588351D',
                'fye'=>Carbon::createFromFormat('Y-m-d', '2023-12-31'),
                'gst_reg_no'=>'201923443T',
                'incorporation_date'=> Carbon::createFromFormat('Y-m-d', '2008-01-11'),
                'company_age'=> '14',
                'no_of_employees'=>'Micro Enterprise (1 - 10)',
                'no_of_offices'=>'5',
                'primary_industry_service_ssic_id'=>3,
                'secondary_industry_service_ssic_id'=>4,
                'address_line'=>"12 East st, Ave 3",
                'status'=>'active',
                'created_by'=> 1,
            ],
            [
                'name'=> 'Hei Home Pte Ltd',
                'uen'=>'201570051C',
                'fye'=>Carbon::createFromFormat('Y-m-d', '2023-12-31'),
                'gst_reg_no'=>'201922233T',
                'incorporation_date'=> Carbon::createFromFormat('Y-m-d', '2009-01-11'),
                'company_age'=> '13',
                'no_of_employees'=>'Medium Enterprise (50 - 249)',
                'no_of_offices'=>'40',
                'primary_industry_service_ssic_id'=>5,
                'secondary_industry_service_ssic_id'=>6,
                'address_line'=>"12 East st, Ave 3",
                'status'=>'active',
                'created_by'=> 2,
            ],
        ];
        foreach ($companies as $company){
//            $company = (new CompanyCreateAction())->execute($company);
            $company = Company::create($company);
        }

        if ($company){
            $company->users()->attach([1 =>
//                ['company_id'=> 1, 'user_id'=> 4, 'user_type'=>'user'],
                ['company_id'=> 2, 'user_id'=> 7, 'user_type'=>'user'],
                ['company_id'=> 3, 'user_id'=> 7, 'user_type'=>'user'],
                ['company_id'=> 2, 'user_id'=> 8, 'user_type'=>'user'],
                ['company_id'=> 1, 'user_id'=> 2, 'user_type'=>'shareholder'],
                ['company_id'=> 1, 'user_id'=> 3, 'user_type'=>'director'],
//                ['company_id'=> 2, 'user_id'=> 2, 'user_type'=>'user'],
//                ['company_id'=> 2, 'user_id'=> 4, 'user_type'=>'user'],
//                ['company_id'=> 3, 'user_id'=> 2, 'user_type'=>'user'],
                ['company_id'=> 3, 'user_id'=> 3, 'user_type'=>'shareholder']
            ]);

        }

//        Company::factory()->count(5000)->create();
    }
}
