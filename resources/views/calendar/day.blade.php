@if(isset($eventsDay['data']))

    @foreach($eventsDay['data'] as $time => $events)
    <div class="card">
        <div class="card-body bg-{{ theme() }}">
            <h3 class="m-0"><strong>{{ $time }}</strong> - {{ $eventsDay['day'] }}</h3>
        </div>
    </div>

    <div class="row m-2">
        @foreach($events as $class)
        <div class="col col-xs-4 d-flex" style="overflow: auto">
            <div class="cards flex-fill px-2 border-right" stysle="max-width: 500px;">
                <div class="card-body">
                    <div>
                        @include('calendar.info')
                        <p>
                            @foreach($class->pendencies as $pendency)
                            <div class="alert list-group-item-{{ $pendency['status'] }} mb-1 p-2">
                                <strong>
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    {{ $pendency['message'] }}
                                </strong>
                            </div>
                            @endforeach
                        </p>

                        @if($class->type != 'AE')
                            @if($class->student->evolutions->count())
                            <div sstyle="width: 500px">
                                @include('calendar.evolutions')
                            </div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="card-footer bg-transparent">
                    @if($class->status == 0)
                    <div class="text-right">
                        <a class="btn btn-danger in-modal" href="{{ route('calendar.edit',  [$class, 'action=absense']) }}">
                            <i class="fas fa-calendar-times    "></i> Marcar Falta
                        </a>
                        <a class="btn bg-olive in-modal" href="{{ route('calendar.edit',  [$class, 'action=presence']) }}">
                            <i class="fas fa-calendar-check"></i> Marcar Presença
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
@endif