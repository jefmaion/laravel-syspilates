<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class TenantUser extends Model
{
    use HasTenant, AuthUser;

    protected $guarded = ['id'];
}
