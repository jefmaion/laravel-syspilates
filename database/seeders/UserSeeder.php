<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\TenantUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Jefferson Maion de Oliveira',
            'email' => 'jefmaion@hotmail.com',
            'password' =>bcrypt('123123123')
        ]);

        $user2 = User::create([
            'name' => 'Gleice Reis',
            'email' => 'gleicelilica@hotmail.com',
            'password' =>bcrypt('123123123')
        ]);

        $tenants = Tenant::all();

        foreach($tenants as $tenant) {
            TenantUser::create([
                'user_id' => $user->id,
                'tenant_id' => $tenant->id
            ]);

            TenantUser::create([
                'user_id' => $user2->id,
                'tenant_id' => $tenant->id
            ]);
        }

    }
}
