<?php

namespace App\Models\Traits;

use App\Models\User;

trait AuthUser {

    protected static function bootAuthUser() {

        static::creating(function($model) {
            if(auth()->user()) {
                $model->auth_user_id = auth()->user()->id;
            }
        });

    }

    public function log() {
        return $this->belongsTo(User::class);
    }

}