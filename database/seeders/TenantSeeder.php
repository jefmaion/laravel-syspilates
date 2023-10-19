<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::create(['name' => 'Studio Levitate', 'domain' => '', 'theme' => 'warning']);
        Tenant::create(['name' => 'Studio Gleice Reis', 'domain' => '', 'theme' => 'lightblue']);
    }
}
