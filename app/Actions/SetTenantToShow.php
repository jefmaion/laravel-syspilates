<?php

namespace App\Actions;

use App\Models\Tenant;

class SetTenantToShow {

    public static function run(Tenant $tenant) {
        setPermissionsTeamId($tenant->id);
        auth()->user()->unsetRelation('roles')->unsetRelation('permissions');

        session()->put('tenant_id', $tenant->id);
        session()->put('tenant_color', $tenant->theme ?? 'primary');
        session()->put('tenant_theme', $tenant->theme ?? 'primary');
        session()->put('tenant_name', $tenant->name);
        session()->put('tenant', $tenant);
    }

}