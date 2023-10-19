<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class RegistrationClass extends Model
{
    use HasTenant, AuthUser;

    protected $guarded = ['id'];


    public function registration() {
        return $this->belongsTo(Registration::class);
    }

    public function instructor() {
        return $this->belongsTo(Instructor::class);
    }
}
