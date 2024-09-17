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
                'first_name' => 'Robert',
                'last_name' => 'Hook',
                'email' => 'pauldebjit84+1@gmail.com',
                'ccs' => ['yahoodebu23+1@gmail.com','yahoodebu23+2@gmail.com'],
            ],
            [
                'first_name' => 'Miguel',
                'last_name' => 'Salazar',
                'email' => 'pauldebjit84+2@gmail.com',
                'ccs' => ['yahoodebu23+3@gmail.com','yahoodebu23+4@gmail.com'],
            ],
            [
                'first_name' => 'Guzman',
                'last_name' => 'Chapo',
                'email' => 'pauldebjit84+3@gmail.com',
                'ccs' => ['yahoodebu23+5@gmail.com','yahoodebu23+6@gmail.com'],
            ],
        ];
        foreach ($company_managements as $company_management){
           $company_management =  CompanyManagement::create($company_management);
        }
    }
}
