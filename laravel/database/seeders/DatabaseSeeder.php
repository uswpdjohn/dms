<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


                //Independent
                $this->call(PermissionsTableSeeder::class);
                 $this->call(CompanyUserSessionSeeder::class);
                 $this->call(SSICTableSeeder::class);
                $this->call(SetupsTableSeeder::class);
                 $this->call(CategoriesTableSeeder::class);
                // $this->call(ShareTypesTableSeeder::class);

                //Dependent
                $this->call(CompaniesTableSeeder::class);
                $this->call(RolesTableSeeder::class);
                $this->call(UsersTableSeeder::class);
                // $this->call(TicketsTableSeeder::class);

                 $this->call(CompanyManagementsTableSeeder::class);

                // $this->call(CompanyMemberTableSeeder::class);
                // $this->call(CapTableActivityTableSeeder::class);
                // $this->call(ESOPTableSeeder::class);
    }
}
