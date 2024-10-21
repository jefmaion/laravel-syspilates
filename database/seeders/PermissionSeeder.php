<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // $acl  = [
        //     'Super' => [],
        //     'Aluno' => [],
        //     'Administrador' => [
        //         'list.registration',
        //         'create.registration',
        //         'show.registration',
        //         'update.registration',
        //         'delete.registration',

        //         'list.user',
        //         'create.user',
        //         'show.user',
        //         'update.user',
        //         'delete.user',

        //         'list.instructor',
        //         'create.instructor',
        //         'show.instructor',
        //         'update.instructor',
        //         'delete.instructor',

        //         'list.modality',
        //         'create.modality',
        //         'show.modality',
        //         'update.modality',
        //         'delete.modality',

        //         'list.monthly',
        //         'create.monthly',
        //         'show.monthly',
        //         'update.monthly',
        //         'delete.monthly',

        //         'list.payable',
        //         'create.payable',
        //         'show.payable',
        //         'update.payable',
        //         'delete.payable',
        //     ],

        //     'Instrutor' => [
        //         'list.registration',
        //         'create.registration',
        //         'show.registration',
        //         'update.registration',
        //         'delete.registration',

        //         'list.user',
        //         'create.user',
        //         'show.user',
        //         'update.user',

        //         'list.monthly',
        //         'create.monthly',
        //         'show.monthly',
        //         'update.monthly',
        //     ]
        // ];

        // $roles       = ['Super', 'Administrador', 'Instrutor', 'Aluno'];

        // $permissions = ['registration', 'user', 'instructor', 'modality', 'monthly', 'payable'];

        // foreach($permissions as $permission) {
        //     $list = ['list', 'create', 'show', 'update', 'delete'];
        //     foreach($list as $action) {
        //         Permission::create(['name' => $action . '.'.$permission]);
        //     }
        // }

        // foreach(Tenant::all() as $tenant) {
        //     foreach($acl as $role => $permissions) {
        //         $_role = Role::create(['name' => $role, 'tenant_id' => $tenant->id]);

        //         if(!empty($permissions)) {
        //             $_role->syncPermissions($permissions);
        //         }
        //     }
        // }


        $user1 = User::where('email', 'jefmaion@hotmail.com')->first();
        $user2 = User::where('email', 'gleicelilica@hotmail.com')->first();
        $user3 = User::where('email', 'helloreis@hotmail.com')->first();

        setPermissionsTeamId(1);
        $user1->assignRole('Super');
        $user2->assignRole(['Administrador', 'Instrutor']);
        $user3->assignRole(['Administrador', 'Instrutor']);

        setPermissionsTeamId(2);
        $user1->assignRole('Super');
        $user2->assignRole(['Instrutor']);
        $user3->assignRole(['Instrutor']);


    }
}
