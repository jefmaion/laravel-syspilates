<div class="row">
    <div class="col-12 col-xl-4 ofsfset-md-3">

        <div class="card card-outline card-{{ theme() }}">

            <div class="card-body">

                @csrf

                <div class="row">

                    <div class="col-12  form-group">
                        <label>Nome da Categoria</label>
                        <x-form.input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" />
                    </div>

                </div>

            </div>

            <div class="card-footer text-right">
                <a name="" id="" class="mr-4 text-muted" href="{{ (isset($category)) ? route('category.show', $category) : route('category.index') }}"
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