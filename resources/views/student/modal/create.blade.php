<form id="form-create" action="{{ route('student.store') }}" method="post">
@csrf
<div class="modal fade" id="modal-create-student" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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

                <div class="alert alert-danger d-none" role="alert">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    <span id="alert-text"></span>
                </div>

                @include('commons.formuser')
                <h6 class="mt-1 border-bottom"><strong>3. Informações Adicionais</strong></h6>
                <div class="row">

                    <div class="col-12  form-group">
                        <label>Profissão</label>
                        <x-form.input type="text" name="student[occupation]" value="{{ old('user.occupation', $student->occupation ?? '') }}" />
                    </div>


                    <div class="col-12 form-group">
                        <label>Observações</label>
                        <textarea class="form-control" name="student[comments]" id="" cols="30"
                            rows="2">{{ old('user.comments', $student->comments ?? '') }}</textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer bg-light">
                <a href="#" class="mr-3 text-muted" data-dismiss="modal">
                    <i class="fas fa-times    "></i> Fechar
                </a>
                <button type="submit" class="btn bg-{{ theme() }}">
                    <x-icon icon="save">Cadastrar Aluno</x-icon>
                </button>
            </div>
        </div>
    </div>
</div>
</form>

@section('scripts')
<script>
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
                        var name = []
                        name  = i.split(/\./)
                        field = '[name="' + name[0] + '[' + name[1] + ']"]'
                        $(field).addClass('is-invalid').next().filter('.invalid-feedback').html(item)
                        $(field).addClass('is-invalid').next().next().filter('.invalid-feedback').html(item)
                    });
                    return
                }
                $('.alert', form).removeClass('d-none')
                $('#alert-text').html(xhr.responseText)
            }
        });
    });


    
</script>
@parent
@endsection