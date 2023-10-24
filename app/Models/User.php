<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tenants() {
        return $this->belongsToMany(Tenant::class, 'tenant_users');
    }


    public function student() {
        return $this->belongsTo(Student::class, 'id', 'user_id');
    }

    public function instructor() {
        return $this->belongsTo(Instructor::class, 'id', 'user_id');
    }

    public function getAgeAttribute() {
        return Carbon::parse($this->birth_date)->age;
    }

    public function getGenderDescriptionAttribute() {
        $genders = ['M' => 'Masculino', 'F' => 'Feminino'];
        return $genders[$this->gender];
    }

    public function getIsBirthdayAttribute() {

        if(!$this->birth_date) {
            return false;
        }

        $birtDate = Carbon::parse($this->birth_date);
        $today = Carbon::parse(date('Y-m-d'));

        return $today->isBirthday($birtDate);
    }


    public function getShortNameAttribute() {
        $names = explode(" ", $this->name);
        return trim(array_shift($names).' '.end($names));
    }

    public function getFullAddressAttribute() {
        return  ($this->address.', ' ?? '') . 
                ($this->number.' ' ?? '').
                ($this->complement. ' - ' ?? '').
                ($this->district . ' - ' ?? '').
                ($this->city . '/' ?? ''). 
                ($this->state .' - ' ?? '').
                ($this->zipcode ?? '');
    }

    public function countStudents() {
        return Student::count();
    }
}
