<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRemarkClassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'classes_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'instructor_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'classes_id'       => 'Aula a repor',
            'date'     => 'Data',
            'time'  => 'Horário',
            'instructor_id'  => 'Professor'
         
        ];
    }
}
