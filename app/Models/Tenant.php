<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['name', 'domain'];

    public function users() {
        return $this->belongsToMany(User::class, 'tenant_users');
    }
}
