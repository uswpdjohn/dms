<?php

namespace Database\Seeders;


use App\Models\Setup;
use Illuminate\Database\Seeder;

class SetupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setups = [
            [
                'key'=> 'login_bg_image',
                'value'=> 'default_bg.jpg'
            ],
            [
                'key'=> 'terms_of_use'
            ],
            [
                'key'=> 'privacy_policy'
            ],
        ];
        foreach ($setups as $setup){
            Setup::create($setup);
        }
    }
}
