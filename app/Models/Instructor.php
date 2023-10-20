<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasTenant, AuthUser;

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function modalities() {
        return $this->belongsToMany(Modality::class, 'instructor_modalities')
            ->using(InstructorModality::class)
            ->withPivot(['id', 'percentual', 'calc_on_absense']);
    }

    public function classes() {
        return $this->hasMany(Classes::class)->whereNotNull('situation');
    }
}
