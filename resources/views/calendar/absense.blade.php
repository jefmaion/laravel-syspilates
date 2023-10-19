<div class="modal fade" id="modal-presence" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content p-2 bg-light">

            {{-- <div class="modal-header bg-light">
                <h6 class="modal-title text-muted">
                    <i class="fas fa-calendar-check    "></i>
                    <strong>Marcar Presença</strong>

                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}

            <div class="modal-header border-0">
                <h5 class="m-0">
                    <i class="fas fa-calendar-times    "></i>
                    <strong>Marcar Falta</strong>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form-absense" action="{{ route('class.absense', $class) }}" method="post">
                @csrf
                @method('put')

            <div class="modal-body">
                @include('calendar.info')

                <div class="row">
                    <div class="col-12 form-group">
                        <label>Tipo de Falta</label>
                        <x-form.select name="situation" value="" :options="[ 'FF' => 'Falta', 'FJ' => 'Falta COM aviso']" />
                    </div>
    
                    <div class="col-12 form-group">
                        <label>Comentários</label>
                        <textarea id="my-textarea" class="form-control" name="comments" rows="3"></textarea>
                    </div>
    
                    <input type="hidden" name="status" value="1">
                </div>
                
    

            </div>

            <div class="modal-footer border-0">

                <a href="#" class="mr-3 text-muted" data-dismiss="modal">
                    Fechar
                </a>


                <button type="button" onclick="sendForm('#form-absense')" class="btn btn-danger">
                    <i class="fas fa-calendar-check"></i> Registrar Falta
                </button>


            </div>

            </form>

        </div>
    </div>
    </form>
</div>


<script>
//     $('#form-absense').submit(function (e) { 
//     e.preventDefault();

//     $.ajax({
//         type: $(this).attr('method'),
//         url: $(this).attr('action'),
//         data: $(this).serialize(),
//         dataType: "json",
//         success: function (response) {
//             $('#modal-presence').modal('hide')
//             refreshCalendar()
//         },
//         error: function(response) {
//             $('.is-invalid').removeClass('is-invalid')
//             $.each(response.responseJSON.errors, function (name, message) { 
//                 $('[name="'+name+'"]').addClass('is-invalid').next().html(message[0])
//             });
        
//         }
//     });
    
// });
</script>