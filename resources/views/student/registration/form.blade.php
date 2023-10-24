<div class="row">
    <div class="col-12">
        <h6 class="border-bottom mb-3"><strong>1. Informações da Matrícula</strong></h6>
        <div class="row">

            <div class="col-3 form-group">
                <label>Modalidade</label>
                <x-form.select name="modality_id" :options="$modalities" :disabled="!empty($registration->id)"
                    value="{{ old('modality_id', $registration->modality_id ?? '') }}"  />
            </div>

            <div class="col-2 form-group">
                <label>Data 1ª Aula</label>
                <x-form.input type="date" name="start" :disabled="!empty($registration->id)"
                    value="{{ old('start',  (($registration->start) ? $registration->start->format('Y-m-d') : date('Y-m-d') )) }}" />
            </div>
        
            
            <div class="col-2 form-group">
                <label>Aula p/semana</label>
                <x-form.select name="class_per_week"
                    :options="[1 => '1 Aula', 2 => '2 Aulas', 3 => '3 Aulas', 4 => '4 Aulas', 5 => '5 Aulas', 6 => '6 Aulas']"
                    value="{{ old('class_per_week', $registration->class_per_week ?? '') }}"
                    :disabled="!empty($registration->id)" />
            </div>
        
            <div class="col-2 form-group">
                <label>Plano</label>
                <x-form.select name="duration" :options="[1 => 'Mensal', 3 => 'Trimestral', 0 => 'Aula Avulsa']"
                    value="{{ old('duration', $registration->duration ?? '') }}" :disabled="!empty($registration->id)" />
            </div>
        
            <div class="col-2 form-group commom-class">
                <label>Valor Plano</label>
                <x-form.input name="value" class="money" value="{{ old('value', $registration->value ?? '') }}"
                    :disabled="!empty($registration->id)" />
            </div>
        
        
            <div class="col form-group commom-class">
                <label>Dia Vencto</label>
                <x-form.input name="due_day" value="{{ old('due_day', $registration->due_day ?? '') }}"
                    :disabled="!empty($registration->id)" />
            </div>

            <div class="col-2 form-group package-class">
                <label>Valor Aula</label>
                <x-form.input name="value" class="money" value="{{ old('value', $registration->value ?? '') }}"
                    :disabled="!empty($registration->id)" />
            </div>

            <div class="col form-group num-class package-class">
                <label>Qtd Aulas</label>
                <x-form.input name="num_classes" type="number"
                    value="{{ old('num_classes', $registration->num_classes ?? '') }}" :disabled="!empty($registration->id)" />
            </div>
        </div>
        
        
        <div class="row">
        
            
        
        
            
        

        </div>
        
        <h6 class="border-bottom mb-3"><strong>2. Pagamento</strong></h6>
        <div class="row">
        
            <div class="col-3 form-group">
                <label>Data 1º Pagamento</label>
                <x-form.input type="date" name="pay_date"
                    value="{{ old('pay_date',  (($registration->pay_date) ? $registration->pay_date->format('Y-m-d') : date('Y-m-d') )) }}"
                    :disabled="!empty($registration->id)" />
            </div>
        
            <div class="col-3 form-group">
                <label>Forma do 1º Pagamento</label>
                <x-form.select name="first_payment_method_id" :options="$payments"
                    value="{{ old('first_payment_method_id', $registration->first_payment_method_id ?? '') }}"
                    :disabled="!empty($registration->id)" />
            </div>
        
            <div class="col-3 form-group" id="other-payments">
                <label>Demais Pagtos.</label>
                <x-form.select name="other_payment_method_id" :options="$payments"
                    value="{{ old('other_payment_method_id', $registration->other_payment_method_id ?? '') }}"
                    :disabled="!empty($registration->id)" />
            </div>

            <div class="col-3 form-group d-flex align-items-center">
                
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="pay" value="1">
                    <label class="custom-control-label" for="customSwitch1">Marcar 1º pagamento como Pago</label>
                    </div>
            </div>
        
        
            <div class="col-12 form-group">
                <label for="">Observações</label>
                <textarea class="form-control" name="" id="" rows="2">{{ old('comments', $registration->comments ?? '') }}</textarea>
            </div>
        
        
        </div>

        

        

        
    </div>

    <div class="col-12">

        <h6 class="border-bottosm mt-0"><strong>3. Agendamento de Aulas</strong> (<a href="#" class="text-muted" data-toggle="modal" data-target="#modal-grade"><i class="fas fa-calendar-alt fa-sm"></i></a>)</h6>


        <table class="table table-striped table-ssm table-bordersed">
            <thead class="thead-light">
                <tr>
                    <th>Dia</th>
                    <th>Horario</th>
                    <th>Professor</th>
                </tr>
            </thead>
            <tbody>
                @foreach(classWeek() as $i => $w)
                <tr>
                    <th class="p-1 align-middle">
                        <h6 class="m-0"><strong>{{ $w }}</strong></h6>
                    </th>
                    <td class="p-1">
                        <input type="hidden" name="class[{{ $i }}][weekday]" value="{{ $i }}">
                        <x-form.select name="class[{{ $i }}][time]" :options="classTime()" value="{{ old('class.'.$i.'.time', $weekclass['time'][$i] ??  (isset($registration->weekclass[$i])) ? $registration->weekclass[$i]->time : '' ) }}" />
                    </td>
                    <td class="p-1">
                        <x-form.select name="class[{{ $i }}][instructor_id]" :options="$instructors" value="{{ old('class.'.$i.'.instructor_id', $weekclass['instructor'][$i] ?? (isset($registration->weekclass[$i]->instructor_id)) ? $registration->weekclass[$i]->instructor_id : '') }}" />
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

</div>



@section('scripts')


<script>
    showFields({{ old('duration', $registration->duration ?? 1) }}, {{ $registration->id ?? 0 }})

    $('[name="duration"]').change(function (e) { 
        e.preventDefault();
        showFields($(this).val())
    });

    function showFields(value, id) {
        
        if(value == 0) {
            show = $('.package-class');
            hide = $('.commom-class')
        } else {
            show = $('.commom-class')
            hide = ('.package-class')

           
        }

        $('#other-payments').hide();
            if(value == 3) {
                $('#other-payments').fadeIn();
            } 

        $(hide).hide();
        $(show).fadeIn();
        

        $('.form-control', hide).attr('disabled', true);
        $('.form-control', show).attr('disabled', false);

        if(id > 0) {
            $('.form-control', hide).attr('disabled', true);
            $('.form-control', show).attr('disabled', true);
        }
    }
</script>

@parent
@endsection