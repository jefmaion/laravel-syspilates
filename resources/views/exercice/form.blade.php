<div class="row">
    <div class="col-12 col-xl-4 ofsfset-md-3">

        <div class="card card-outline card-{{ theme() }}">

            <div class="card-body">

                @csrf

                <div class="row">

                    <div class="col-12  form-group">
                        <label>Nome Exercício/Aparelho</label>
                        <x-form.input type="text" name="name" value="{{ old('name', $exercice->name ?? '') }}" />
                    </div>

                    <div class="col-12  form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" name="description" id="" cols="30"
                            rows="3">{{ old('description', $exercice->description ?? '') }}</textarea>
                    </div>


                </div>

            </div>

            <div class="card-footer text-right">
                <a name="" id="" class="mr-4 text-muted"
                    href="{{ (isset($exercice)) ? route('exercice.show', $exercice) : route('exercice.index') }}"
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