<div class="modal fade" id="modal-remarks" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-2  bg-light">
            <form action="{{ route('calendar.remark') }}" id="form-remark" method="post">
                @csrf
               

                <div class="modal-header bg-lights border-0">
                    
    
                    <h5 class="m-0">
                        <strong><i class="fas fa-calendar-plus    "></i>
                            Agendar Reposição de Aula</strong>
                    </h5>
    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
    
                </div>

                <div class="modal-body pb-0">
                    <div class="row">

                        <input type="hidden" name="type" value="RP">

                        <div class="col-12">
                            <h6 class="border-bottom"><strong>1. Informações do Aluno</strong></h6>
                        </div>

                        <div class="col-12  form-group">
                            <label>Aula a Repor</label>
                            <x-form.select name="classes_id" class="select2 w-100" :options="$classes" value="{{ request()->get('class') }}" />
                        </div>


                        <div class="col-12">
                            <h6 class="border-bottom"><strong>1. Informações da Aula</strong></h6>
                        </div>

                        <div class="col-6  form-group">
                            <label>Data</label>
                            <x-form.input type="date" name="date" value="{{ request()->get('date') }}" />
                        </div>

                        <div class="col-6  form-group">
                            <label>Hora</label>
                            <x-form.select name="time" class="select2 w-100" value="{{ request()->get('time') }}" :options="classTime()" />
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
                <div class="modal-footer border-0">
                    <a href="#" class="mr-4 text-muted" data-dismiss="modal">Fechar</a>
                    <button type="button" onclick="sendForm('#form-remark')" class="btn bg-{{ theme() }}">
                        <i class="fas fa-calendar-check    "></i>
                        Agendar Reposição
                    </button>
                </div>
            </form>
        </div>
    </div>


  
</div>