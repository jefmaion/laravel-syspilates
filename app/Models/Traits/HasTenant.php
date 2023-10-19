<?php

namespace App\Models\Traits;

use App\Models\Tenant;
use App\Scopes\TenantScope;

trait HasTenant {

    protected static function bootHasTenant() {

        static::addGlobalScope(new TenantScope());

        static::creating(function($model) {
            if(session()->has('tenant_id') && !is_null(session()->get('tenant_id'))) {
                $model->tenant_id = session('tenant_id');
            }
        });

    }

    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

}