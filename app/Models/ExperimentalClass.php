<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class ExperimentalClass extends Model
{
    use HasTenant, AuthUser;

    protected $guarded = ['id'];

    protected $dates = ['date'];

    public function instructor() {
        return $this->belongsTo(Instructor::class);
    }

    public function modality() {
        return $this->belongsTo(Modality::class);
    }
}
