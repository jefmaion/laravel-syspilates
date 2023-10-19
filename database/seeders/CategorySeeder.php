<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach(Tenant::all() as $tenant) {
            Category::create(['tenant_id' => $tenant->id, 'name' => 'Mensalidades', 'editable' => 1]);
            Category::create(['tenant_id' => $tenant->id, 'name' => 'Vendas', 'editable' => 1]);
            Category::create(['tenant_id' => $tenant->id, 'name' => 'Material de Escritório']);
            Category::create(['tenant_id' => $tenant->id, 'name' => 'Material de Limpeza']);
            Category::create(['tenant_id' => $tenant->id, 'name' => 'Outros']);
        }

        
    }
}
