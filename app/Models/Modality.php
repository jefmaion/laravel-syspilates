<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class Modality extends Model
{
    use HasTenant, AuthUser;

    protected $guarded = ['id'];

    public function getNameWithNickAttribute() {
        return $this->name . ' ('.$this->nick.')';
    }
}
