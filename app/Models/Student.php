<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasTenant, AuthUser;

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * List all registrations
     *
     * @return void
     */
    public function registrations() {
        return $this->hasMany(Registration::class);
    }

    /**
     * List just registrations actives
     *
     * @return void
     */
    public function activeRegistrations() {
        return $this->registrations()->with('modality')->where('is_active', 1);
    }

    /**
     * List all classes independent of registrations
     *
     * @return void
     */
    public function classes() {
        return $this->hasMany(Classes::class)->orderBy('date', 'desc');
    }

    public function classesResume() {
        return $this->classes()->selectRaw("COUNT(*) as total")
        ->selectRaw("SUM(CASE WHEN status = 1 AND situation = 'PP' THEN 1 ELSE 0 END) as presences")
        ->selectRaw("SUM(CASE WHEN status = 1 AND situation IN ('FF', 'FJ') THEN 1 ELSE 0 END) as absenses")
        ->selectRaw("SUM(CASE WHEN type = 'RP' THEN 1 ELSE 0 END) as repositions");
    }



    public function files() {
        return $this->hasMany(Files::class);
    }

    public function installments() {
        return $this->hasMany(Transaction::class);
    }

    public function installmentsToPay() {
        return $this->installments()->where('status', 0)->whereDate('date', '<=', now())->where('type', 'R');
    }

    public function evolutions() {
        return $this->classes()->with('instructor')->whereNotNull('evolution_date')->orderBy('date', 'desc');
    }

    public function repositions() {
        return $this->classes()->with('modality')->with('repositions')->where('student_id', $this->id)
                    ->whereNotIn('id', function($q)  {
                        $q->select('class_reposition_id')
                        ->from('classes')
                        ->where('student_id', $this->id)
                        ->whereNotNull('class_reposition_id')
                        ->where('status', 0)
                        ->whereNull('deleted_at');
                    })
                    ->where('situation', 'FJ')
                    ->where('type', 'AN')
                    ->where('has_reposition', 0);
    }

    public function getStatusAttribute() {
        return ($this->activeRegistrations()->exists()) ? 'Matriculado' : 'Sem Matricula';
    }

}
