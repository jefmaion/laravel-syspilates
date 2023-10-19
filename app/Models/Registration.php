<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasTenant, AuthUser, SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['start', 'end', 'pay_date'];


    public function modality() {
        return $this->belongsTo(Modality::class);
    }

    public function classes() {
        return $this->hasMany(Classes::class);
    }

    public function weekdays() {
        return $this->hasMany(RegistrationClass::class);
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }



    public function getWeekClassAttribute() {
        return (array) json_decode($this->class_week);
    }

    public function getDaysToRenewAttribute() {
        $today = Carbon::parse(date('Y-m-d'));
        return $today->diffInDays($this->end, false);
    }

    public function getValuePerClassAttribute() {
        return $this->value / $this->classes()->count();
    }

    public function getPlanDescriptionAttribute() {
        $plans = [
            0 => 'Aula Avulsa',
            1 => 'Mensal',
            2 => 'Bimestral',
            3 => 'Trimestral',
            12 => 'Anual'
        ];

        return $plans[$this->duration];
    }

    public function getDayClassesAttribute() {

        $data = [];
        foreach($this->weekclass as $wk) {
            $data[] = substr(classWeek($wk->weekday),0,3) . ' ' . date('h\h\\', strtotime($wk->time));
        }

        return implode(" / ", $data);
        

    }

    public function getPositionAttribute() {
        $today = Carbon::parse(date('Y-m-d'));
        $renew =  Carbon::parse($this->end)->subDays(3);

        $daysToRenew = $today->diffInDays($this->end, false);

        if($daysToRenew < 0) {
            return 'Finalizada';
        }

        if($today->eq($this->end)) {
            return 'Renovar hoje';
        }

        if($daysToRenew <= 3) {
            return 'Vence em ' . $daysToRenew . ' dia(s)';
        }

        if($today->between($this->start, $this->end)) {
            return 'Em andamento';
        }

        

        return 'Em andamento';
    }
}
