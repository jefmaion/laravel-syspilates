<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstructorRequest extends StoreUserRequest
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
        return array_merge(parent::rules(), [
            'instructor.occupation' => 'required'
        ]);
    }

    public function attributes()
    {
        return array_merge(parent::attributes(),[
            'instructor.occupation' => 'Profissão'
        ]);
    }
}
