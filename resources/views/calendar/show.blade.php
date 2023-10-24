<div class="modal fade" id="modal-event-{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content p-2">
         
            <div class="modal-header bg-lights border-0">
                {{-- <h6 class="modal-title text-muted">
                    <i class="fas fa-calendar-alt    "></i>
                    <strong>{{ $class->typeDescription }} de {{ $class->modality->name }}</strong>

                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}

                <h5 class="m-0">
                    {{-- <strong><i class="fas fa-calendar-alt    "></i> {{ $class->typeDescription }} de {{ $class->modality->name }}</strong> --}}
                    <strong><i class="fas fa-calendar-alt    "></i> {{ $class->fullDate }}</strong>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body pb-0">

                @include('calendar.info')


                @if(!$class->isExperimental)
                    <div class="mb-3">
 

                        @foreach($class->listPendencies as $pendency)
                        <div class="alert list-group-item-{{ $pendency['status'] }} mb-1 p-2">
                            <strong>
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                {{ $pendency['message'] }}
                            </strong>
                        </div>
                        @endforeach
                    </div>

                    <div class="card card-{{ theme() }} card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                        href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                        aria-selected="true">Evoluções</a>
                                </li>
                                @if(count($class->student->repositions))
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                                        aria-selected="false">Reposições Pendentes <span class="badge badge-pill badge-secondary">{{ count($repositions) }}</span></a>
                                </li>
                                @endif
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
                                    @else
                                        <p class="m-0 text-csenter text-muted">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>    
                                            Nenhuma evolução encontrada.
                                        </p>                                    
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Modalidade</th>
                                                <th>Motivo da Falta</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($class->student->repositions as $repo)
                                            <tr class="bg-light">
                                                <td scope="row">
                                                    <a data-toggle="collapse" href="#class-repo-{{ $repo->id }}">{{ $repo->date->format('d/m/Y') }} {{ $repo->time }}</a>
                                                    </td>
                                                <td>{{ $repo->modality->name }}</td>
                                                <td>{{ $repo->comments }}</td>
                                                <td>
                                                    <a class="in-modal" href="{{ route('calendar.show.remark', ['class' => $repo->id]) }}">Agendar reposição</a>
                                                </td>
                                            </tr>

                                            @foreach($repo->repositions as $rps)
                                            <tr class="collapse" id="class-repo-{{ $repo->id }}">
                                                <td class="ml-4">{{ $rps->date->format('d/m/Y') }} {{ $rps->time }}</td>
                                                <td>{{ $rps->statusDescription }}</td>
                                                <td>{{ $rps->comments }}</td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            @endforeach

                                            @endforeach
                                        
                                        </tbody>
                                    </table>
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
            <div class="modal-footer pt-1 border-0 d-flex justify-content-between">

      
                    <div>
                        
                        <div class="dropdown">
                            <a href="#" class="text-muted dropdown-toggle" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Mais
                            </a>
                            <div class="dropdown-menu" aria-labelledby="triggerId">
                                @if($class->status == 1)
                                <a class="dropdown-item reset-class" href="#" data-toggle="modal" data-target="#modasl-restore">
                                    <i class="fas fa-calendar-times    "></i>
                                    Remover  {{ ($class->situation == 'PP') ? 'Presença' : 'Falta' }}
                                </a>
                                @endif

                                {{-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-edit    "></i>
                                    Editar Aula
                                </a> 

                                <div class="dropdown-divider"></div>

                                --}}
                                
                                <a class="dropdown-item delete-class" href="#" data-toggle="modal" data-target="#modsal-delete-class">
                                    <i class="fas fa-trash-alt    "></i>
                                    Excluir Aula
                                </a>
                                
                            </div>
                        </div>

                    </div>
                


                <div>
                    
                    <a href="#" class="mr-4 text-muted" data-dismiss="modal">
                        Fechar
                    </a>
    
                    @if($class->isExperimental && $class->status == 1 && $class->situation == 'PP' && !isset($class->student->activeRegistrations))
                        <a class="btn bg-purple" href="{{ route('student.create', ['name' => $class->studentName, 'phone_wpp' => $class->studentPhone, 'class' => $class->id]) }}">
                            <i class="fas fa-calendar-times    "></i> Matricular
                        </a>
                    @endif
    
                    @if($class->type !== 'AN')
                        {{-- Excluir --}}
                    @endif
    
                    @if($class->status == 0)
                        <a class="btn btn-danger in-modal" href="{{ route('calendar.edit',  [$class, 'action=absense']) }}">
                            <i class="fas fa-calendar-times    "></i> Marcar Falta
                        </a>
    
                        <a class="btn bg-olive in-modal" href="{{ route('calendar.edit',  [$class, 'action=presence']) }}">
                            <i class="fas fa-calendar-check"></i> Marcar Presença
                        </a>
                    @endif

                </div>


            </div>
        </div>
    </div>

    <script>
        $('.reset-class').click(function (e) { 
            e.preventDefault();
            $('[name="class_id"]').val('{{ $class->id }}')
            $('#modelId').modal('show')
        });

        $('.delete-class').click(function (e) { 
            e.preventDefault();
            $('#modal-delete-class form').attr('action', '{{ route('calendar.destroy', $class) }}')
            $('#modal-delete-class').modal('show')
        });
    </script>


    
    <!-- Modal -->
    <div class="modal fade" id="modelId2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    Body
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

</div>