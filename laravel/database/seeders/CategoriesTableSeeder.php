<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'slug'=> 'business_information',
                'name'=> 'Business Information'
            ],
            [
                'slug'=> 'mailbox',
                'name'=> 'Mailbox'
            ],
            [
                'slug'=> 'corporate_secretary',
                'name'=> 'Corporate Secretary'
            ],
            [
                'slug'=> 'gst_report',
                'name'=> 'GST Report'
            ],
            [
                'slug'=> 'human_resource',
                'name'=> 'Human Resource'
            ],
//            [
//                'slug'=> 'cap_table',
//                'name'=> 'CAP Table'
//            ],
//            [
//                'slug'=> 'esop',
//                'name'=> 'ESOP'
//            ],
//            [
//                'slug'=> 'billings',
//                'name'=> 'Billings'
//            ],
            [
                'slug'=> 'others',
                'name'=> 'Others'
            ],

        ];
        foreach ($categories as $category){
            Category::create($category);
        }
    }
}
