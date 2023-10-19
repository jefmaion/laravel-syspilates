<x-modal-delete class="text-muted" id="class-{{ $class->id }}" route="{{ route('class.destroy', $class) }}">
    <i class="fas fa-trash-alt    "></i>
</x-modal-delete>


{{-- <a href="#" class="text-muted" data-toggle="modal" data-target="#modal-delete-{{ $class->id }}">
    <i class="fas fa-trash-alt    "></i>
</a>

<div class="modal" id="modal-delete-{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Excluir Registro
                </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body ">
                <h2 class="text-center p-4 font-weight-light">Deseja excluir esse registro?</h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light border" data-dismiss="modal">
                    <x-icon icon="close">Fechar</x-icon>
                </button>
                <form action="{{ route('class.destroy', $class) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <x-icon icon="delete">Excluir</x-icon>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> --}}