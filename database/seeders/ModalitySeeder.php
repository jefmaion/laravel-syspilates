<?php

namespace Database\Seeders;

use App\Models\Modality;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenants = Tenant::all();
        foreach($tenants as $tenant) {
            Modality::create(['name' => 'Pilates', 'nick' => 'PLT', 'tenant_id' => $tenant->id]);
            Modality::create(['name' => 'Low Pressure Fitness', 'nick' => 'LPF', 'tenant_id' => $tenant->id]);
        }

        
    }
}
