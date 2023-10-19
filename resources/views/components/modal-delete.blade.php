
<a name="" id="" {{ $attributes->merge(['class' => 'bbtn bbtn-outline-danger']) }}  href="#" data-toggle="modal" data-target="#modal-delete-{{ $attributes['id'] }}" role="button">
    {{ $slot }}
</a>

@section('outcontent')
<div class="modal" id="modal-delete-{{ $attributes['id'] }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-2">
            {{-- <div class="modal-header bg-danger">
                <h5 class="modal-title">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Excluir Registro
                </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div> --}}

            <div class="modal-header border-0">

                <h5 class="m-0 text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Excluir Registro</h5>

               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body ">
                {{-- <h2 class="text-center p-4 font-weight-light">Deseja excluir esse registro?</h2> --}}
                <p class="font-weight-normal">Deseja excluir esse registro?</p>
                
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-outline-light border" data-dismiss="modal">
                    <x-icon icon="close">Fechar</x-icon>
                </button>
                <form action="{{ $attributes['route'] }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <x-icon icon="delete">Excluir</x-icon>
                    </button>
                </form>
            </div> --}}

            <div class="modal-footer border-0 text-left">
                <a href="#" class="mr-3 text-muted" data-dismiss="modal">Não, cancelar</a>
                <form action="{{ $attributes['route'] }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger badge-psill px-4 py-2 ">
                        <x-icon icon="delete">Excluir</x-icon>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@parent
@endsection