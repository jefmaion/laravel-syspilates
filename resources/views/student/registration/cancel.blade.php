<div class="modal fade" id="model-cancel-{{ $registration->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-2">
            <div class="modal-header border-0">
                <h5 class="m-0"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Cancelar Modalidade</h5>

               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div class="modal-body p-4">
                
                {{-- <h3 class="p-4 font-weight-light">Deseja
                    cancelar as aulas de <strong>{{
                        $registration->modality->name }}?</strong></h3> --}}

                        <p class="font-weight-normal">Deseja
                            cancelar as aulas de <strong>{{
                                $registration->modality->name }}?</strong></p>
            </div>
            <div class="modal-footer border-0 text-left">
                <form action="{{ route('student.registration.destroy', [$student, $registration]) }}" method="post">
                    @csrf
                    @method('delete')
                    <a href="#" class="mr-4 text-muted" data-dismiss="modal">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Fechar
                    </a>
                    <button type="submit" class="btn bg-{{ theme() }}">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        Cancelar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>