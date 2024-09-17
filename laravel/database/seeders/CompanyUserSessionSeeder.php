<?php

namespace Database\Seeders;

use App\Models\CompanyUserSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyUserSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'key'  => 'company_id'
            ]
        ];
        foreach ($data as $item){
            CompanyUserSession::create($item);
        }
    }
}
