<?php

namespace Database\Seeders;

use App\Actions\Permission\SyncPermission;
use App\Actions\User\UserCreateAction;
use App\Http\Requests\CreateUserRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $users = [

            [
                'first_name'=> 'Shiny',
                'last_name'=> 'Verghese',
                'email'=>'shiny.owner@gmail.com',
                'designation'=>'Owner',
                'password'=>'123456',
                'status'=>'active',
                'role'=>'Company Owner',
            ],
            [
                'first_name'=> 'Shiny',
                'last_name'=> 'Verghese',
                'email'=>'shiny.general@gmail.com',
                'designation'=>'Owner',
                'password'=>'123456',
                'status'=>'active',
                'role'=>'General User',
            ],
            [
                'first_name'=> 'Shiny',
                'last_name'=> 'Verghese',
                'email'=>'shiny.user@gmail.com',
                'designation'=>'Owner',
                'password'=>'123456',
                'status'=>'active',
                'role'=>'Company User',
            ],
            [
                'first_name'=> 'PD',
                'last_name'=> 'John Owner',
                'email'=>'john.owner@gmail.com',
                'designation'=>'Owner',
                'password'=>'123456',
                'status'=>'active',
                'role'=>'Company Owner',
            ],
            [
                'first_name'=> 'PD',
                'last_name'=> 'John User',
                'email'=>'john.user@gmail.com',
                'designation'=>'Owner',
                'password'=>'123456',
                'status'=>'active',
                'role'=>'Company User',
            ],
            [
                'first_name'=> 'PD',
                'last_name'=> 'John User(2)',
                'email'=>'john.user2@gmail.com',
                'designation'=>'Owner',
                'password'=>'123456',
                'status'=>'active',
                'role'=>'Company User',
            ],
            [
                'first_name'=> 'PD',
                'last_name'=> 'John General',
                'email'=>'john.general@gmail.com',
                'designation'=>'Owner',
                'password'=>'123456',
                'status'=>'active',
                'role'=>'General User',
            ],

            [
                'first_name'=> 'Blythe ',
                'last_name'=> 'Price',
                'email'=>'admin4@gmail.com',
                'designation'=>'Support Executive',
                'password'=>'123456',
                'status'=>'active',
                'role'=>'General User',
            ],
            [
                'first_name'=> 'Stephen',
                'last_name'=> 'Hawking',
                'email'=>'pauldebjit84@gmail.com',
                'designation'=>'Manager',
                'password'=>'123456',
                'status'=>'active',
                'role'=>'Company User',
            ],
            [
                'first_name'=> 'PD ',
                'last_name'=> 'John',
                'email'=>'admin3@gmail.com',
                'designation'=>'Support Executive',
                'password'=>'123456',
                'status'=>'active',
                'role'=>'Super Admin',
            ]
        ];


        foreach ($users as $item){
            $role= Role::whereName($item['role'])->first();
            $user=User::create([
                'first_name'=>$item['first_name'],
                'last_name'=>$item['last_name'],
                'email'=>$item['email'],
                'designation'=>$item['designation'],
                'password'=>$item['password'],
                'status'=>$item['status'],
            ]);
            if ($role){
                $user->assignRole($role);
            }
            if($item['email'] == 'shiny.user@gmail.com'){
                $company = Company::where('id', 1)->first();
                $company->users()->attach($user->id, ['user_type' => 'user']);
            }
            if($item['email'] == 'shiny.owner@gmail.com'){
                $employee=User::create([
                    'first_name'=>'Shiny',
                    'last_name'=>'Verghese',
                    'email'=>'shiny.management@gmail.com',
                    'designation'=>'Executive',
                    'password'=>'123456',
                    'status'=>'active',
                    'created_by'=>$user->id,
                ]);
                $employee->assignRole('Employee');
            }
            if($item['email'] == 'john.owner@gmail.com'){
                $employee=User::create([
                    'first_name'=> 'PD',
                    'last_name'=> 'John Management',
                    'email'=>'john.management@gmail.com',
                    'designation'=>'Management',
                    'password'=>'123456',
                    'status'=>'active',
                    'created_by'=>$user->id,
                ]);
                $employee->assignRole('Employee');
            }
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
//            if ($role->name=='Admin' || $role->name=='Super Admin'){
//                (new SyncPermission())->execute($user, Permission::get()->pluck('name')->toArray());

//                $permission = ['delete.mailbox','show.ticket','update.ticket','delete.ticket','create.user','update.user','show.user','delete.user'];
//                (new SyncPermission())->execute($role, $permission);

//                $user->syncPermissions(Permission::all());
//                $role->syncPermissions(['delete.mailbox','show.ticket','update.ticket','delete.ticket','create.user','update.user','show.user','delete.user']);
//            }
//            (new UserCreateAction())->execute($user);
        }

    }
}
