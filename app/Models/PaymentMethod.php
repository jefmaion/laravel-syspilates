<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use AuthUser;

    protected $guarded = ['id'];
}
