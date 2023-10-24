<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasTenant, AuthUser;

    protected $guarded = ['id'];
    protected $dates = ['date', 'pay_date'];


    protected static function booted()
    {
        // you can do the same thing using anonymous function
        // let's add another scope using anonymous function
        static::creating(function($model) {
            $model->original_value = $model->value;
        });
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function method() {
        return $this->belongsTo(PaymentMethod::class,   'payment_method_id', 'id');
    }

    public function registration() {
        return $this->belongsTo(Registration::class);
    }

    public function getFeesValueAttribute() {
        
        $fees = 0;
        $payDate =  Carbon::parse(date('Y-m-d'));
        $dueDate = Carbon::parse($this->date);

        if($payDate > $dueDate) {
            $daysLate  = $payDate->diffInDays($dueDate);
            $fees      = $daysLate * (0.033/100);
            $fees = ($fees * $this->value) +  ($this->value * 0.02);
        }

        return $fees;
    }

    public function getValueWithFeesAttribute() {
        return $this->value + $this->feesValue;
    }

    public function getStatusCodeAttribute() {
        
       

        if($this->date->format('Y-m-d') === date('Y-m-d') && $this->status == 0) {
            return 2;
        }

        if($this->date->format('Y-m-d') > date('Y-m-d') && $this->status == 0) {
            return 3;
        }

        if($this->date->format('Y-m-d') < date('Y-m-d') && $this->status == 0) {
            return 4;
        }

        if(in_array($this->status, [0,1])) {
            return $this->status;
        }
    }


    public function getStatusDescriptionAttribute() {
        if($this->status == 1) {
            return 'Pago';
        }
       

        if($this->date->format('Y-m-d') === date('Y-m-d') && $this->status == 0) {
            return 'Pagar Hoje';
        }

        if($this->date->format('Y-m-d') > date('Y-m-d') && $this->status == 0) {
            return 'Aberto';
        }

        if($this->date->format('Y-m-d') < date('Y-m-d') && $this->status == 0) {
            return 'Atrasada';
        }
    }
}
