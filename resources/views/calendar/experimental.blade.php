

    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  " role="document">
            <form id="form-experimental" action="{{ route('classes.experimental.store') }}" method="post">
                @csrf
            <div class="modal-content p-2 bg-light">
                
                <div class="modal-header border-0">
                    
    
                    <h5 class="m-0">
                        <strong>
                            <i class="fas fa-calendar-plus    "></i>
                            Agendar Aula Experimental
                        </strong>
                    </h5>
    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
    
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" name="type" value="AE">

                        <div class="col-12">
                            <h6 class="border-bottom"><strong>1. Informações do Aluno</strong></h6>
                        </div>

                        <div class="col-8 form-group">
                            <label>Nome</label>
                            <x-form.input name="name" value="" />
                        </div>

                        <div class="col-4 form-group">
                            <label>Telefone</label>
                            <x-form.input name="phone_wpp" value="" />
                        </div>

                        <div class="col-12">
                            <h6 class="border-bottom"><strong>2. Informações da Aula</strong></h6>
                        </div>

                        <div class="col-6  form-group">
                            <label>Data</label>
                            <x-form.input type="date" name="date" value="{{ request()->get('date') ?? date('Y-m-d')  }}" />
                        </div>

                        <div class="col-6  form-group">
                            <label>Hora</label>
                            <x-form.select name="time" class="select2 w-100" value="{{ request()->get('time') ?? date('H:00:00') }}" :options="classTime()" />
                        </div>

                        <div class="col-8  form-group">
                            <label>Modalidade</label>
                            <x-form.select name="modality_id" class="select2 w-100" value="" :options="$modalities ?? []" />
                        </div>

                        <div class="col-4 form-group">
                            <label>Valor da Aula</label>
                            <x-form.input name="value" class="money" value="" />
                        </div>

                        <div class="col-12  form-group">
                            <label>Professor</label>
                            <x-form.select name="instructor_id" class="select2 w-100"
                                value="{{ old('instructor_id', $class->instructor_id ?? '') }}"
                                :options="$instructors ?? []" />
                        </div>

                        <div class="col-12">
                            <h6 class="border-bottom"><strong>3. Informações Adicionais</strong></h6>
                        </div>

                        <div class="col-12 form-group">
                            <textarea class="form-control" name="comments" id="" cols="30" rows="2"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer border-0">
                    <a href="#" class="mr-4 text-muted" data-dismiss="modal">Fechar</a>
                    <button type="button" onclick="sendForm('#form-experimental')" class="btn bg-{{ theme() }}">
                        <i class="fas fa-calendar-check    "></i>
                        Agendar Aula Experimental
                    </button>
                </div>
            </div>
        </form>

        </div>
    </div>

    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.config.js') }}"></script>