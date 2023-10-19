<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperimentalClassRequest extends FormRequest
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
            'name' => 'required',
            'phone_wpp' => 'required',
            'instructor_id' => 'required',
            'modality_id' => 'required',
            'date'  => 'required',
            'time' => 'required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'value' => currency($this->value, true)
        ]);

    }

    public function attributes() {
        return [
            'name' => 'Nome',
            'phone_wpp' => 'Telefone',
            'instructor_id' => 'Professor',
            'modality_id' => 'Modalidade',
            'date'  => 'Data',
            'time' => 'Hora'
        ];
    }
}
