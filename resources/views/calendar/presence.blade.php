<div class="modal fade" id="modal-presence" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg"
        role="document">
        <div class="modal-content p-2 bg-light">

            <div class="modal-header border-0">
                <h5 class="m-0">
                    <i class="fas fa-calendar-check    "></i>
                    <strong>Marcar Presença</strong>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- <div class="modal-header bg-light">
                <h6 class="modal-title text-muted">
                    <i class="fas fa-calendar-check    "></i>
                    <strong>Marcar Presença</strong>

                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            {{-- {{ route('class.update', $class) }} --}}
            <form id="form-presence" action="{{ route('class.presence', $class) }}" method="post">
                @csrf
                @method('put')

                <div class="modal-body">

                    @include('calendar.info')
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                {{-- <div class="col-12 form-group">
                                    <label>Exercícios Executados</label>
                                    <x-form.select name="exercice_id[]" multiple class="select2 w-100" value=""
                                        :options="$exercices" />
                                </div> --}}


                                <div class="col-12 form-group">
                                    <label>Evolução da Aula</label>
                                    <textarea class="form-control" rows="5" name="evolution"></textarea>
                                </div>
                            </div>
                        </div>
                        @if(!$class->isExperimental)
                            @if($class->student->evolutions->count())
                            <div class="col-12">
                                <div><strong>Últimas Evoluções</strong></div>
                                <div style="height:300px; overflow:auto">
                                    @include('calendar.evolutions')
                                </div>
                            </div>
                            @endif
                        @endif
                    </div>

                    <input type="hidden" name="type" value="{{ $class->type }}">




                </div>

                <div class="modal-footer border-0">

                    <a href="#" class="mr-3 text-muted" data-dismiss="modal">
                        Fechar
                    </a>


                    <button type="button" onclick="sendForm('#form-presence')" class="btn btn-success">
                        <i class="fas fa-calendar-check"></i> Registrar Presença
                    </button>


                </div>

            </form>

        </div>
    </div>
    </form>


    <script>
    // $('#form-absense').submit(function (e) { 
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
    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    </script>
</div>