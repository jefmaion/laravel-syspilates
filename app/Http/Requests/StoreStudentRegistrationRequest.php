<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRegistrationRequest extends FormRequest
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
            // 'student_id' => 'required',
            'modality_id' => ['required', 
                            Rule::unique('registrations')->where(function($query) {
                                return $query->where('student_id', $this->student)
                                            ->whereNull('deleted_at')
                                            ->where('modality_id', $this->modality_id)
                                            ->where('is_active', 1)
                                            ->where('tenant_id', session('tenant_id'));
                            })],
            'duration' => 'required',
            'start' => 'required',
            'class_per_week' => 'required|numeric|min:1',
            'due_day' => 'sometimes|required',
            'value' => 'required',
            'num_classes' => 'sometimes|required_if:duration,0',

            'first_payment_method_id' => 'required',
            'other_payment_method_id' => 'required_unless:duration,0,1',

            'class' => 'array|min:'.$this->class_per_week.'|max:'.$this->class_per_week,
            'class.*.instructor_id' => 'required_with:class.*.time',
            'class.*.time' => 'required_with:class.*.instructor_id'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'value' => currency($this->value, true)
        ]);

        $values = [];
        foreach($this->class as $key => $item) {

            //verifica se ta vazio
            if(empty($item['instructor_id']) && empty($item['time'])) {
                continue;
            }

            $values[$key] = $item;
        }

        $this->merge([
            'class' => $values
        ]);
    }

    protected function filters()
    {
        return [
            'number' => 'intval', // <- will "filter" through php's intval. could be any callable
        ];
    }

    public function messages()
    {
        return [
            'modality_id.unique' => 'Essa modalidade já está cadastrada',
        ];
    }

    public function attributes()
    {
        return [
            'modality_id'        => 'Modalidade',
            'duration'  => 'Plano',
            'remuneration_value' => 'Valor da Remuneração',
            'start' => 'Data da Matrícula',
            'class_per_week' => 'Aulas por Semana',
            'due_day' => 'Vencimento',
            'value' => 'Valor',

            'first_payment_method_id' => 'Tipo 1º Pagamento',
            'other_payment_method_id' => 'Tipo Outros Pagamentos',

            'class' => 'Aulas',
            'class.*.instructor_id' => 'Professor',
            'class.*.time' => 'Horario'
        ];
    }
}
