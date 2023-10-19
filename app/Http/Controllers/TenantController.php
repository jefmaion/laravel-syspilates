<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    
    public function change($id) {
        $tenant = auth()->user()->tenants()->findOrFail($id);
        session()->put('tenant_id', $tenant->id);
        session()->put('tenant_name', $tenant->name);
        session()->put('tenant_theme', $tenant->theme);
        return redirect()->route('calendar.index');
    }

}
