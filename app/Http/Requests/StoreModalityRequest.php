<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreModalityRequest extends FormRequest
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
            'name' => ['required',
                        Rule::unique('modalities')->where(function($query) {
                            return $query->where('tenant_id', session('tenant_id'));
                        })],
        ];
    }

    public function attributes() {
        return [
            'name' => 'Modalidade'
        ];
    }
}
