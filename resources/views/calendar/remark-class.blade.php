<div class="modal fade" id="modal-remark" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('calendar.remark') }}" method="post">
                @csrf
                <div class="modal-header bg-{{ theme() }}">
                    <h5 class="modal-title">
                        <i class="fas fa-calendar-plus    "></i>
                        Remarcar Aula
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('calendar.info')
                    <div class="row">

                        <input type="hidden" name="type" value="RP">

                        <div class="col-6  form-group">
                            <label>Data</label>
                            <x-form.input type="date" name="date" value="" />
                        </div>

                        <div class="col-6  form-group">
                            <label>Hora</label>
                            <x-form.select name="time" class="select2 w-100" value="" :options="classTime()" />
                        </div>

                        <div class="col-12  form-group">
                            <label>Professor</label>
                            <x-form.select name="instructor_id" class="select2 w-100"
                                value="{{ old('instructor_id', $class->instructor_id ?? '') }}"
                                :options="$instructors ?? []" />
                        </div>



                        <div class="col-12 form-group">
                            <label>Observações</label>
                            <textarea class="form-control" name="comments" id="" cols="30" rows="2"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="mr-4 text-muted" data-dismiss="modal">Fechar</a>
                    <button type="submit" class="btn bg-{{ theme() }}">
                        <i class="fas fa-calendar-check    "></i>
                        Agendar
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        $('[name="student_id"]').change(function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "calendar/class/list-not-remark",
                    data: {
                        _token: '{{ csrf_token() }}',
                        student_id: $(this).val()
                    },
                    dataType: 'json',
                    success: function (response) {
                        var select = $('[name="classes_id"]');
                        $(select).empty();
                        $.each(response, function (i, v) { 
                            $(select).append('<option value="'+i+'">'+v+'</option>');
                        });
                    }
                });
            });

    </script>

</div>