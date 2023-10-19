<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InstructorModality extends Pivot
{
    use AuthUser;

    protected $guarded = ['id'];

    public function getAbsenseAttribute() {
        return ($this->calc_on_absense == 1) ? 'Sim' : 'Não';
    }
}
