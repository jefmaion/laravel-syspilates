<div class="row">
    <div class="col-12 col-xl-4 ofsfset-md-3">

        <div class="card card-outline card-{{ theme() }}">

            <div class="card-body">

                @csrf

                <div class="row">

                    <div class="col-12  form-group">
                        <label>Nome da Modalidade</label>
                        <x-form.input type="text" name="name" value="{{ old('name', $modality->name ?? '') }}" />
                    </div>

                    <div class="col-12  form-group">
                        <label>Sigla (3 letras)</label>
                        <x-form.input type="text" name="nick" maxlength="3" value="{{ old('nick', $modality->nick ?? '') }}" />
                    </div>


                </div>

            </div>

            <div class="card-footer text-right">
                <a name="" id="" class="mr-4 text-muted" href="{{ (isset($modality)) ? route('modality.show', $modality) : route('modality.index') }}"
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