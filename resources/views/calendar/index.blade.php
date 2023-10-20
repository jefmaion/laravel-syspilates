@extends('_template.main')


@section('pageheader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                <i class="fas fa-calendar-alt    "></i>
                <strong>Calendario</strong></span>

            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('calendar.index') }}">Calendário</a></li>
                {{-- <li class="breadcrumb-item active">{{ $student->user->firstName }}</li> --}}
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="card card-outline card-{{theme()}}">
    <div class="card-body">
        <div class="row">
            <div class="col-auto d-flex align-items-end">
                <div class="dropdown">
                    <button class="btn btn-lg bg-{{ theme() }} dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-calendar-alt    "></i> Agendar
                    </button>
                    <div class="dropdown-menu" aria-labelledby="triggerId">
                        <a class="dropdown-item in-modal" href="{{ route('calendar.show.experimental') }}">
                            <i class="fas fa-calendar-check"></i>
                            Aula Experimental
                        </a>
                        <a class="dropdown-item in-modal" href="{{ route('calendar.show.remark') }}">
                            <i class="fas fa-calendar-check"></i>
                            Reposição
                        </a>
                    </div>
                </div>
            </div>
            <div class="col align-items-end">
                <div class="row ">
                    <div class="col">
                        <label>Instrutor</label>
                        <x-form.select class="item-calendar" name="filter[instructor_id]" :options="$instructors" value="" />
                    </div>
                    <div class="col">
                        <label>Aluno</label>
                        <x-form.select class="item-calendar" name="filter[student_id]" :options="$students" />
                    </div>
                    <div class="col">
                        <label>Modalidade</label>
                        <x-form.select class="item-calendar" name="filter[modality_id]" :options="$modalities" />
                    </div>
                    <div class="col">
                        <label>Tipo de Aula</label>
                        <x-form.select class="item-calendar" name="filter[type]" :options="$classTypes" />
                    </div>
                    <div class="col">
                        <label>Status Aula</label>
                        <x-form.select class="item-calendar" name="filter[situation]" :options="$classStatus" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="calendar-tab-tab" data-toggle="pill" href="#calendar-tab" role="tab" aria-controls="calendar-tab" aria-selected="true">
                    <i class="fas fa-calendar-alt    "></i>
                    Calendario
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="calendar-day-tab" data-toggle="pill" href="#calendar-day" role="tab" aria-controls="calendar-day" aria-selected="false">
                    <i class="fas fa-calendar-alt    "></i>
                    Aulas do Dia
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="custom-tabs-four-tabContent">
        <div class="tab-pane fade active show p-0" id="calendar-tab" role="tabpanel"
            aria-labelledby="calendar-tab-tab">
            <div id="calendar-class"></div>
        </div>
        <div class="tab-pane fade" id="calendar-day" role="tabpanel" aria-labelledby="calendar-day-tab">
            @include('calendar.day')
        </div>
    </div>
</div>


<div id="modals"></div>

<div class="modal" id="modelId" tabindex="-50" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-2">
            <div class="modal-header border-0">
                <h5 class="m-0">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Remover Presença/Falta
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="font-weight-normal">Tem certeza que deseja remover a presença/falta dessa aula? A evolução
                    referente a ela também será excluída</p>
            </div>
            <div class="modal-footer border-0 text-left">
                <a href="#" class="mr-3 text-muted" data-dismiss="modal">Não, cancelar</a>
                <form action="{{ route('class.reset') }}" method="post">
                    @csrf
                    <input type="hidden" name="class_id" value="">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-times-circle" aria-hidden="true"></i> Remover
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-delete-class" tabindex="-50" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-2">
            <div class="modal-header border-0">
                <h5 class="m-0">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Excluir Aula
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="font-weight-normal">Tem certeza que deseja excluir essa aula?</p>
            </div>
            <div class="modal-footer border-0 text-left">
                <a href="#" class="mr-3 text-muted" data-dismiss="modal">Não, cancelar</a>
                <form action="" id="form-delete-class" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="sendForm('#form-delete-class')" class="btn btn-danger">
                        <i class="fa fa-times-circle" aria-hidden="true"></i> Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@include('calendar.context')
@include('_template.components.select2')
@endsection

@section('css')
<style>
.bg-primarys { background-color: #6777ef !important;}
</style>
<link rel="stylesheet" href="{{ asset('template/plugins/fullcalendar/main.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('template/plugins/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('js/config.js') }}"></script>
<script src="{{ asset('template/plugins/fullcalendar/locales/pt-br.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/moment@2.27.0/min/moment.min.js'></script>
<script>

    showInModal();

    var calendar = null
    var Calendar = FullCalendar.Calendar;

    var calendar = new Calendar(document.getElementById('calendar-class'), {
        locale: 'pt-BR',
        initialView: 'timeGridWeek',
        allDaySlot: false,
        height: 'auto',
        editable: true,
        selectable: true,
        slotMinTime: "07:00",
        slotMaxTime: "21:00",
        hiddenDays: [0],
        nowIndicator:true,
        slotDuration: '00:60:00',
        eventOrder: "-type",
        slotEventOverlap:false,
        themeSystem: 'bootstrap',
        slotLabelFormat: {
            hour: 'numeric',
            minute: '2-digit',
        },
        headerToolbar: {
            left  : 'prev,next today',
            center: 'title',
            right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: {
            url: 'calendar/list',
            extraParams: function() {
                    obj = {}
                    $('.item-calendar').each(function (index, element) {
                        if($(this).val()) {
                            name = $(this).attr('name');
                            obj[name] = $('[name="'+name+'"]').val()
                        }
                    });
                    return obj
                },
            failure: function() {
                showToastr('Houve um erro ao recuperar os eventos do calendário', 'error')
            }
        },
        eventContent: function( info ) {
            return {
                html: info.event.title
            };
        },
        dateClick: function(info) {
            date = moment(new Date(info.date))
            time = moment(new Date(info.date))
            $('#context-datetime').html(date.format('DD/MM/YYYY') + ' às ' + time.format('HH:mm:ss'))
            $('#list-context .list-group-item-action').each(function (index, element) {
                href = $(element).attr('href').split('?')[0] 
                href = href  + '?date='+date.format('YYYY-MM-DD')+'&time='+ time.format('HH:mm:ss');
                $(element).attr('href', href)
            });      
            $('#modal-context').modal('show');
        },
        eventDrop: function(info) {
            props = info.event.extendedProps;
            start = moment(new Date(info.event.start)).format('YYYY-MM-DD')
            old = moment(new Date(info.oldEvent.start)).format('YYYY-MM-DD')
            time = moment(new Date(info.event.start)).format('HH:mm:ss')
            
            // if((start !== old) && (props.class_type !== 'AE')) {
            //     showToastr('Não é possível mover eventos para outros dias, apenas dentro do dia atual', 'warning')
            //     return info.revert();
            // }
            
            return moveEvent(info, start, time)
            
        },
        eventClick: function(info) {

            id = info.event.id

            console.log(info.event.extendedProps)
            

            if(info.event.extendedProps.event_type == 'class') {
                showClass(id);
            }

            if(info.event.extendedProps.event_type == 'recurrent') {
                showRenew(id);
            }
            
        }
    });

    calendar.render();

    $('.item-calendar').change(function (e) { 
        refreshCalendar();
    });

    function moveEvent(info, start, time){
        
        endpoint = 'class/'

        $.ajax({
            type: "post",
            url: endpoint + info.event.id,
            data: {
                _method: 'put',
                _token: '{{ csrf_token() }}',
                date: start,
                time: time   
            },
            success: function (response) {
                showToastr('Evento alterado com sucesso!')
                refreshCalendar();
            }, 
            error: function(e) {
                info.revert();
                showToastr('Não foi possível mover esse evento', 'error')
            }
        });
    }

    function refreshCalendar() {
        calendar.refetchEvents();
    }

    // function showRemark() {
    //     $.ajax({
    //         type: "get",
    //         url: "calendar/remark",
    //         success: function (response) {
    //             showModal(response)
    //         }
    //     });
    // }
        
    function showClass(eventId) {
        $.ajax({
            type: "post",
            url: "calendar/event",
            data: {
                _token: '{{ csrf_token() }}',
                id: eventId,
            },
            success: function (response) {
                showModal(response)
            },
            error: function(response) {
                if(response.responseJSON.message) {
                    showToastr(response.responseJSON.message, 'error');
                }
            }
        });
    }

    function showRenew(eventId) {
        $.ajax({
            type: "get",
            url: "calendar/renew/" + eventId,
            success: function (response) {
                showModal(response)
            },
            error: function(response) {
                if(response.responseJSON.message) {
                    showToastr(response.responseJSON.message, 'error');
                }
            }
        });
    }

    function showModal(content) {
        $('#modals .modal').modal('hide')
        modal = '#' + $(content).attr('id');

        $('#modals').append(content);
        showInModal(modal)
        
        $(modal).modal('show')

        $(modal).on('hidden.bs.modal', function () {
            $(this).remove();
        });

        
    }

    function showInModal(modal) {
        modal = (typeof modal   === 'undefined') ? '' : modal

        $(modal + ' .in-modal').on('click', function (e) { 
            
            e.preventDefault();
            $.ajax({
                type: "get",
                url: $(this).attr('href'),
                success: function (response) {
                    showModal(response)
                    
                }
            });
        });
    }
    
    function setRemark(status, url) {
        remark    = status
        remarkUrl = url
        classes   = 'border border-warning fc-border-yellow'

        $('#card-main').removeClass(classes);
        $('.remark-alert').addClass('d-none')

        if(status) {
            $('#card-main').addClass(classes);
            $('.remark-alert').removeClass('d-none')
        }
    }

    function showToastr(message, type) {
        type = (typeof type   === 'undefined') ? 'success' : type
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-full-width",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        eval('toastr.' + type)(message)
        $('#toast-container').addClass('nopacity');
    }

    function sendForm(form) {
        
        var _form = $(form);
        $.ajax({
            type: $(_form).attr('method'),
            url: $(_form).attr('action'),
            data: $(_form).serialize(),
            dataType: "json",
            success: function (response) {
                refreshCalendar()
                if(response.message) {
                    showToastr(response.message)
                }

                $('body .modal').modal('hide')
            },
            error: function(response) {

                $('.is-invalid').removeClass('is-invalid')

                $.each(response.responseJSON.errors, function (name, message) { 
                    $('[name="'+name+'"]').addClass('is-invalid').next().html(message[0])
                });

                if(!response.responseJSON.success) {
                    showToastr(response.responseJSON.message, 'error');
                }
            }
        });
    }
</script>
@parent
@endsection