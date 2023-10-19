<div class="modal-content">

    <div class="modal-header bg-light">
        <h6 class="modal-title text-muted">
            <i class="fas fa-calendar-alt    "></i>
            <strong>{{ $class->typeDescription }} de {{ $class->modality->name }}</strong>

        </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        @include('calendar.info')

        @if(!$class->isExperimental)
        <div class="mb-3">
            @if($class->canReposition)
            <div class="alert list-group-item-warning mb-1 p-2">
                <strong>
                    <i class="fa fa-exclamation-triangle mr-2" aria-hidden="true"></i>
                    Aula de reposição não agendada
                    {{-- Data limite: {{ $class->reposition_date_limit }} <a
                        href="{{ route('calendar.remark') }}" class="in-modal">Remarcar</a> --}}
                </strong>
            </div>
            @endif

            @if($class->student->installmentsToPay->count())
            <div class="alert list-group-item-danger mb-1 p-2">
                <strong>
                    <i class="fa fa-exclamation-triangle mr-2" aria-hidden="true"></i>
                    Pagamentos a realizar!
                </strong>
            </div>
            @endif
        </div>

        <div class="card card-{{ theme() }} card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                            href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                            aria-selected="true">Evoluções</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                            href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                            aria-selected="false">Aulas a repor</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                            href="#custom-tabs-four-messages" role="tab"
                            aria-controls="custom-tabs-four-messages" aria-selected="false">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                            href="#custom-tabs-four-settings" role="tab"
                            aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
                    </li> --}}
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                        aria-labelledby="custom-tabs-four-home-tab">
                        @if($class->student->evolutions->count())
                            @include('calendar.evolutions')
                        @endif
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                        aria-labelledby="custom-tabs-four-profile-tab">
                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus
                        ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                        posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula
                        placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet
                        ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                        aria-labelledby="custom-tabs-four-messages-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus
                        volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce
                        nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue
                        ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur
                        eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur,
                        ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex
                        vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus.
                        Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                        aria-labelledby="custom-tabs-four-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus
                        turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis
                        vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum
                        pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget
                        aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac
                        habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                </div>
            </div>

        </div>

        @endif
        


    </div>
    <div class="modal-footer">

        <a href="#" class="mr-4 text-muted" data-dismiss="modal">
            Fechar
        </a>


        @if($class->isExperimental && $class->status == 1 && $class->situation == 'PP' && empty($class->student->activeRegistrations))
        <a class="btn bg-purple" href="{{ route('student.create', ['name' => $class->studentName, 'phone_wpp' => $class->studentPhone, 'class' => $class->id]) }}">
            <i class="fas fa-calendar-times    "></i> Matricular
        </a>
        @endif

        @if($class->status == 0)
            <a class="btn btn-danger in-modal" href="{{ route('calendar.edit',  [$class, 'action=absense']) }}">
                <i class="fas fa-calendar-times    "></i> Marcar Falta
            </a>

            <a class="btn btn-success in-modal" href="{{ route('calendar.edit',  [$class, 'action=presence']) }}">
                <i class="fas fa-calendar-check"></i> Marcar Presença
            </a>
        @else

        <a class="btn btn-secondary reset-class" href="#" data-toggle="modal" data-target="#modal-restore">
            <i class="fas fa-sync    "></i> Remover Presença/Falta
        </a>

        @endif


    </div>
</div>