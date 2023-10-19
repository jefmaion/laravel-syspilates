<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user.name'       => 'required',
            'user.gender'     => 'required',
            'user.phone_wpp'  => 'required',
            'user.cpf'  => 'required',
            'user.birth_date' => 'required|date'
        ];
    }



    public function attributes()
    {
        return [
            'user.name'       => 'Nome',
            'user.gender'     => 'Sexo',
            'user.phone_wpp'  => 'Telefone WhatsApp',
            'user.cpf'  => 'CPF',
            'user.birth_date' => 'Data de Nascimento'
         
        ];
    }
}
