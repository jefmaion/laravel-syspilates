@csrf


<div class="row">
    <div class="col-4  form-group">
        <label>Data</label>
        <x-form.input type="date" name="date"
            value="{{ old('date', ($class->date) ?  $class->date->format('Y-m-d') : date('Y-m-d') ?? '') }}" />
    </div>

    <div class="col-4  form-group">
        <label>Hora</label>
        <x-form.select name="time" class="select2 w-100" value="{{ old('time', $class->time ?? '') }}"
            :options="classTime()" />
    </div>

    <div class="col-4  form-group">
        <label>Tipo de Aula</label>
        <x-form.select name="type" class="select2 w-100" value="{{ old('type', $class->type ?? '') }}"
            :options="$class->classTypes" />
    </div>

    


    <div class="col-12  form-group">
        <label>Professor</label>
        <x-form.select name="instructor_id" class="select2 w-100"
            value="{{ old('instructor_id', $class->instructor_id ?? '') }}" :options="$instructors ?? []" />
    </div>

    <div class="col-12  form-group">
        <label>Situação da Aula</label>
        <x-form.select name="situation" class="select2 w-100" value="{{ old('situatio', $class->situation ?? '') }}"
            :options="$class->situationTypes" />
    </div>

    <div class="col-12 form-group">
        <label>Evolução</label>
        <textarea class="form-control" name="evolution" id="" cols="30"
            rows="3">{{ old('evolution', $class->evolution ?? '') }}</textarea>
    </div>

    <div class="col-12 form-group">
        <label>Observações</label>
        <textarea class="form-control" name="comments" id="" cols="30"
            rows="3">{{ old('comments', $class->comments ?? '') }}</textarea>
    </div>

    
</div>