<form id="form-create" action="{{ route('student.registration.store', $student) }}" method="post">
    @csrf
    <div class="modal fade" id="modal-add-modality" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-{{ theme() }}">
                    <h5 class="modal-title">
                        <strong><i class="fa fa-user-plus" aria-hidden="true"></i> Novo Aluno</strong>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                </div>
                <div class="modal-footer bg-light">
                    <a href="#" class="mr-3 text-muted" data-dismiss="modal">
                        <i class="fas fa-times    "></i> Fechar
                    </a>
                    <button type="submit" class="btn bg-{{ theme() }}">
                        <x-icon icon="save">Adicionar Modalidade</x-icon>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@section('scripts')
<script>
    $('#modal-add-modality').on('show.bs.modal', function (event) {

            var modal = $(this);

            $.ajax({
                type: "get",
                url: "{{ route('student.registration.create', $student) }}",


                success: function (response) {
                    $('.modal-body', modal).html(response)

                    showFields({{ old('duration', $registration->duration ?? 1) }}, {{ $registration->id ?? 0 }})
    
                    $('[name="duration"]').change(function (e) { 
                        e.preventDefault();
                        showFields($(this).val())
                    });
                
                    function showFields(value, id) {
                
                        if(value == 0) {
                            show = $('.package-class');
                            hide = $('.commom-class')
                        } else {
                            show = $('.commom-class')
                            hide = ('.package-class')
                
                        
                        }
                
                        $('#other-payments').hide();
                            if(value == 3) {
                                $('#other-payments').fadeIn();
                            } 
                
                        $(hide).hide();
                        $(show).fadeIn();
                        
                
                        $('.form-control', hide).attr('disabled', true);
                        $('.form-control', show).attr('disabled', false);
                
                        if(id > 0) {
                            $('.form-control', hide).attr('disabled', true);
                            $('.form-control', show).attr('disabled', true);
                        }
                    }

                    $('#form-create').submit(function (e) { 
    
    
                        e.preventDefault();
                        var form = $(this)
                        $.ajax({
                            type: $(form).attr('method'),
                            url: $(form).attr('action'),
                            data: $(form).serialize(),
                            beforeSend: function(e) {
                                $('.alert', form).addClass('d-none')
                                $('.is-invalid').removeClass('is-invalid')
                            },
                            success: function (response) {
                                location.reload()
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                if(xhr.responseJSON.errors) {
                                    $.each(xhr.responseJSON.errors, function (i, item) { 
                                        field = '[name="'+i+'"]'
                                        $(field).addClass('is-invalid').next().filter('.invalid-feedback').html(item)
                                    });
                                    return
                                }
                                $('.alert', form).removeClass('d-none')
                                $('#alert-text').html(xhr.responseText)
                            }
                        });
                    });
                }
            });
        })

      
    
    
        
</script>
<script>

</script>

@parent
@endsection