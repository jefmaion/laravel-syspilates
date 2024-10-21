<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPUnit\Framework\isNull;

class Classes extends Model
{
    use HasTenant, AuthUser, SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['date', 'evolution_date'];


    public function instructor() {
        return $this->belongsTo(Instructor::class)->with('user');
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function modality() {
        return $this->belongsTo(Modality::class);
    }

    public function registration() {
        return $this->belongsTo(Registration::class);
    }

    public function parent() {
        return $this->belongsTo(Classes::class, 'class_reposition_id', 'id');
    }

    public function repositions() {
        return $this->hasMany(Classes::class, 'class_reposition_id', 'id');
    }

    public function repositions2() {
        return $this->hasMany(Classes::class, 'class_reposition_id', 'id');
    }

    public function getLastRepositionAttribute() {
        return $this->repositions()->orderBy('date', 'desc')->limit(1)->first();
    }


    public function getCanRepositionAttribute() {
        if(in_array($this->situation, ['CC', 'FJ']) &&  !in_array($this->type, ['AE', 'RP']) && !$this->repositions) {
            return true;
        }

        return false;
    }

    public function getFullDateAttribute() {
        return dateExt($this->date);
    }

    public function getComboAttribute() {
        return $this->date->format('d/m/Y') . ' - ' . $this->student->user->shortName . ' - ' . $this->modality->name;
    }

    public function getIsExperimentalAttribute() {
        return ($this->type == 'AE');
    }

    public function getStudentNameAttribute() {

        if(isset($this->student->user)) {
            return $this->student->user->shortName;
        }

        return $this->name;
    }

    public function getStudentPhoneAttribute() {

        if(isset($this->student->user)) {
            return $this->student->user->phone_wpp;

        }

        return $this->phone_wpp;
    }

    public function getStatusDescriptionAttribute() {
        if(is_null($this->situation)) {
            return 'Agendada';
        }

        return $this->situationTypes[$this->situation];

        // if($this->status == 1) {
        //     return 'Finalizada';
        // }
    }

    public function getTypeDescriptionAttribute() {
        $types = $this->classTypes;
        return $types[$this->type];
    }

    public function getClassTypesAttribute() {
        return  [
            'AN' => 'Aula Normal',
            'RP' => 'Reposição',
            'AV' => 'Aula Avulsa',
            'AE' => 'Aula Experimental'
        ];
    }

    public function getSituationTypesAttribute() {
        return  [
            NULL => 'Agendada',
            'PP' => 'Presença',
            'FF' => 'Falta',
            'FJ' => 'Falta Justificada',
            'CC' => 'Cancelada'
        ];
    }

    public function getListPendenciesAttribute() {
        $pendencies = [];

        if($this->student->installmentsToPay->count() > 0) {
            $pendencies[] = ['status' => 'danger', 'message' => 'Pagamentos a realizar!'];
        }

        if($this->student->repositions()->count()) {
            $pendencies[] = ['status' => 'warning', 'message' => 'Reposições não agendadas!'];
        }

        if($this->registration->daysToRenew <= 3) {
            $pendencies[] = ['status' => 'info', 'message' => 'Matrícula em '.$this->registration->modality->name . ' ' .  $this->registration->position];
        }

        return $pendencies;
    }


}
