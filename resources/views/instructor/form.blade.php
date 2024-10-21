<div class="row">
    <div class="col-12 col-xl-12 ofsfset-md-3">

        <div class="card card-outline card-{{ theme() }}">

            <div class="card-body">

                @csrf

                @include('commons.formuser')

                <h6 class="my-3 border-bottom"><strong>3. Informações Adicionais</strong></h6>
                <div class="row">

                    <div class="col-6  form-group">
                        <label>Formação</label>
                        <x-form.input type="text" name="instructor[occupation]"
                            value="{{ old('instructor.occupation', $instructor->occupation ?? '') }}" />
                    </div>

                    <div class="col-6  form-group">
                        <label>Documento da Categoria (CREF/CREFITO)</label>
                        <x-form.input type="text" name="instructor[document]"
                            value="{{ old('instructor.document', $instructor->document ?? '') }}" />
                    </div>

                    <div class="col-12 form-group">
                        <label>Observações</label>
                        <textarea class="form-control" name="instructor[comments]" id="" cols="30"
                            rows="3">{{ old('instructor.comments', $instructor->comments ?? '') }}</textarea>
                    </div>
                </div>

                @if(!isset($instructor->id))


                <h6 class="my-3 border-bottom"><strong>4. Acesso</strong></h6>
                <div class="row">

                    <div class="col-6  form-group">
                        <label></label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="send-access" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Gerar senha de acesso e enviar por email</label>
                            </div>
                    </div>


                </div>

                @endif


            </div>

            <div class="card-footer">
                <a name="" id="" class="mr-4 text-muted" href="{{ (isset($instructor)) ? route('instructor.show', $instructor) : route('instructor.index') }}"
                    role="button">
                    <x-icon icon="back">Voltar</x-icon>
                </a>

                <button type="submit" class="btn bg-{{ theme() }}">
                    <x-icon icon="save">Salvar Alterações</x-icon>
                </button>
            </div>
        </div>
    </div>

</div>
