<div class="modal" id="modal-context" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mosdal-sm" role="document">
        <div class="modal-content p-2">

            <div class="modal-header border-0">

                <h5><i class="fas fa-calendar-alt"></i> <span id="context-datetime"></span></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="list-group list-group-flush" id="list-context">

                <a href="{{ route('calendar.show.experimental') }}"
                    class="list-group-item list-group-item-action in-modal" data-dismiss="modal">
                    <strong><i class="fas mr-1 fa-calendar-plus    "></i> Agendar Aula Experimental</strong>
                </a>

                <a href="{{ route('calendar.show.remark') }}" class="in-modal list-group-item list-group-item-action"
                    data-dismiss="modal">
                    <strong><i class="fas mr-1 fa-calendar-plus    "></i> Agendar Reposição</strong>
                </a>

            </div>


            <div class="modal-footer border-0">
                <a href="#" class="mr-4 text-muted" data-dismiss="modal">Fechar</a>
            </div>
        </div>
    </div>
</div>