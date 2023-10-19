<div class="row">
    <div class="col-12 col-xl-6 ofsfset-md-3">

        <div class="card card-outline card-{{ theme() }}">

            <div class="card-body">

                @csrf

                @include('commons.formuser')

                <h6 class="border-bottom"><strong>3. Informações Adicionais</strong></h6>
                <div class="row">

                    <div class="col-12  form-group">
                        <label>Profissão</label>
                        <x-form.input type="text" name="student[occupation]" value="{{ old('user.occupation', $student->occupation ?? '') }}" />
                    </div>

                   
                    <div class="col-12 form-group">
                        <label>Observações</label>
                        <textarea class="form-control" name="student[comments]" id="" cols="30"
                            rows="2">{{ old('user.comments', $student->comments ?? '') }}</textarea>
                    </div>
                </div>


            </div>

            <div class="card-footer text-right">
                <a name="" id="" class="mr-4 text-muted" href="{{ (isset($student)) ? route('student.show', $student) : route('student.index') }}"
                    role="button">
                    <x-icon icon="back">Voltar</x-icon>
                </a>

                <button type="submit" class="btn bg-{{ theme() }}">
                    <x-icon icon="save">Salvar</x-icon>
                </button>
            </div>
        </div>
    </div>

</div>