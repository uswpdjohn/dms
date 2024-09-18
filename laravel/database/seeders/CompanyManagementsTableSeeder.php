<?php

namespace Database\Seeders;

use App\Models\CompanyManagement;
use Illuminate\Database\Seeder;

class CompanyManagementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyManagement::truncate();
        $company_managements=[
            [
                'first_name' => 'PD',
                'last_name' => 'John',
                'email' => 'pdjohnusw9975@gmail.com',
                'ccs' => ['pdjohnusw9975+3@gmail.com','pdjohnusw9975+4@gmail.com'],
            ],
            [
                'first_name' => 'Pd',
                'last_name' => 'John USW',
                'email' => 'pdjohnusw9975+1@gmail.com',
                'ccs' => ['pdjohnusw9975+5@gmail.com','pdjohnusw9975+6@gmail.com'],
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Pd',
                'email' => 'pdjohnusw9975+2@gmail.com',
                'ccs' => ['pdjohnusw9975+7@gmail.com','pdjohnusw997+8@gmail.com'],
            ],
        ];
        foreach ($company_managements as $company_management){
           $company_management =  CompanyManagement::create($company_management);
        }
    }
}
