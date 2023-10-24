<?php

namespace App\Models;

use App\Models\Traits\AuthUser;
use App\Models\Traits\HasTenant;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasTenant, AuthUser;

    protected $table = 'student_files';
    protected $guarded = ['id'];

    protected static function booted()
    {
        // you can do the same thing using anonymous function
        // let's add another scope using anonymous function
        static::deleting(function($model) {
            // $model->original_value = $model->value;

            if(file_exists(public_path('file/'.$model->student_id.'/'.$model->name))) {
                unlink(public_path('file/'.$model->student_id.'/'.$model->name));
            }
        });
    }


    public function getSizeToHumanAttribute()
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $this->size > 1024; $i++) {
            $this->size /= 1024;
        }

        return round($this->size, 2) . ' ' . $units[$i];
    }
}
