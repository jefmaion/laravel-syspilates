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
                <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Alunos</a></li>
                {{-- <li class="breadcrumb-item active">{{ $student->user->firstName }}</li> --}}
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

{{-- @include('calendar.experimental')
--}}



<div class="card card-outline card-{{theme()}}">

    <div class="card-body pb-0">
        <div class="dropdown">
            <button class="btn bg-{{ theme() }} dropdown-toggle" type="button" id="triggerId"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <i class="fas fa-calendar-alt    "></i> Agendar
            </button>
            <div class="dropdown-menu" aria-labelledby="triggerId">
                {{-- <h6 class="dropdown-header text-left">Aula</h6> --}}
                <a class="dropdown-item in-modal" href="{{ route('calendar.show.experimental') }}">
                    <i class="fas fa-calendar-check"></i>
                    Aula Experimental
                </a>

                <a class="dropdown-item in-modal" href="{{ route('calendar.show.remark') }}">
                    <i class="fas fa-calendar-check"></i>
                    Reposição
                </a>


                {{-- <a class="dropdown-item" href="#">Action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">After divider action</a> --}}
            </div>
        </div>

        <div class="row">
            <div class="col">

                
                


                <!-- Button trigger modal -->
                {{-- <a href="{{ route('calendar.show.experimental') }}" class="btn bg-{{ theme() }} in-modal">
                    <i class="fas fa-calendar-check    "></i>
                    Agendar Aula Experimental
                </a>


                <a class="in-modal btn bg-{{ theme() }}" href="{{ route('calendar.show.remark') }}">
                    <i class="fas fa-calendar-check    "></i>
                    Agendar Reposição
                </a> --}}

                <!-- Modal -->
            </div>
        </div>


        {{-- <div class="row ">
            <div class="col">
                <label>Instrutor</label>
                <x-form.select class="item-calendar form-control-sm" name="_instructor_id" :options="$instructors"
                    value="" />
            </div>
            <div class="col">
                <label>Aluno</label>
                <x-form.select class="item-calendar form-control-sm " name="_student_id" :options="$students" />
            </div>
            <div class="col">
                <label>Modalidade</label>
                <x-form.select class="item-calendar form-control-sm " name="_modality_id" :options="$modalities" />
            </div>
            <div class="col">
                <label>Tipo de Aula</label>
                <x-form.select class="item-calendar form-control-sm " name="_type"
                    :options="['AN' => 'Aula Normal', 'RP' => 'Reposição', 'AE' => 'Aula Experimental']" />
            </div>
            <div class="col">
                <label>Status Aula</label>
                <x-form.select class="item-calendar form-control-sm " name="_status"
                    :options="[0 => 'Agendada', 1 => 'Realizada', 2 => 'Falta Com Aviso', 3 => 'Falta']" />
            </div>
        </div> --}}
    </div>


    {{--<div class="card-body">
        <div class="row ">
            <div class="col form-group">
                <label>Instrutor</label>
                <x-form.select class="item-calendar form-control-sm select2" name="_instructor_id"
                    :options="$instructors" value="" />
            </div>
            <div class="col form-group">
                <label>Aluno</label>
                <x-form.select class="item-calendar form-control-sm select2" name="_student_id" :options="$students" />
            </div>
            <div class="col form-group">
                <label>Modalidade</label>
                <x-form.select class="item-calendar form-control-sm select2" name="_modality_id"
                    :options="$modalities" />
            </div>
            <div class="col form-group">
                <label>Tipo de Aula</label>
                <x-form.select class="item-calendar form-control-sm select2" name="_type"
                    :options="['AN' => 'Aula Normal', 'RP' => 'Reposição', 'AE' => 'Aula Experimental']" />
            </div>
            <div class="col form-group">
                <label>Status Aula</label>
                <x-form.select class="item-calendar form-control-sm select2" name="_status"
                    :options="[0 => 'Agendada', 1 => 'Realizada', 2 => 'Falta Com Aviso', 3 => 'Falta']" />
            </div>
        </div>
    </div>
    --}}
    <div id="calendar-class"></div>
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
    .bg-primarys {
        background-color: #6777ef !important;
    }
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
    // showInModal();

    var calendar = null
        var remark = false
        var remarkUrl = null

        var Calendar = FullCalendar.Calendar;
        var calendarEl = document.getElementById('calendar-class');

        var calendar = new Calendar(calendarEl, {
            locale: 'pt-BR',
            headerToolbar: {
                left  : 'prev,next today',
                center: 'title',
                right : 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            initialView: 'timeGridWeek',
            allDaySlot: false,
            height: 'auto',
            editable: true,
            selectable: true,
            slotMinTime: "07:00",
            slotMaxTime: "21:00",
            slotLabelFormat: {
                hour: 'numeric',
                minute: '2-digit',
            },
            hiddenDays: [0],
            nowIndicator:true,
            slotDuration: '00:60:00',
            // eventOrderStrict:true,
            eventOrder: "-type",
            slotEventOverlap:false,
            themeSystem: 'bootstrap',
            eventDidMount: (arg) =>{
                const eventId = arg.event.id
                arg.el.addEventListener("contextmenu", (jsEvent)=>{
                    jsEvent.preventDefault()
                    console.log("contextMenu", eventId)
                })
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

                // alert('Clicked on: ' + info.dateStr);
                // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                // alert('Current view: ' + info.view.type);
                // // change the day's background color just for fun
                // info.dayEl.style.backgroundColor = 'red';
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
                showClass(info.event);
            }
        });

        calendar.render();


        $('.item-calendar').change(function (e) { 
            refreshCalendar();
        });

        

        function moveEvent(info, start, time){
            
            endpoint = 'class/'

            if(info.event.extendedProps.event_type == 'experimental') {
                endpoint = 'class/experimental/'
            }


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

        function getParameters() {
            obj = {}
            $('.item-calendar').each(function (index, element) {
                name = $(this).attr('name');
                obj[name] = $('[name="'+name+'"]').val()
            });
            return obj
        }
            
        function refreshCalendar() {
            // calendar.fullCalendar('refetchEvents');
            calendar.refetchEvents();
        }

       function showRemark() {
            $.ajax({
                type: "get",
                url: "calendar/remark",
                success: function (response) {
                  showModal(response)
                }
            });
       }
            
        function showClass(event) {

            console.log(event);

            $.ajax({
                type: "post",
                url: "calendar/event",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: event.id,
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

        showInModal()

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
                        console.log(response)
                        $('body .modal').modal('hide')
                        refreshCalendar()

                        if(response.message) {
                            showToastr(response.message)
                        }
                    },
                    error: function(response) {
                        console.log(response)
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

        


        // $('#form-experimental').submit(function (e) { 


        //     e.preventDefault();
        //     var form = $(this)
        //     $.ajax({
        //         type: $(form).attr('method'),
        //         url: $(form).attr('action'),
        //         data: $(form).serialize(),
        //         beforeSend: function(e) {
        //             $('.alert', form).addClass('d-none')
        //             $('.is-invalid').removeClass('is-invalid')
        //         },
        //         success: function (response) {
        //             refreshCalendar()
        //             showToastr('Evento cadastrado com sucesso!')
        //             $('.modal').modal('hide')
        //         },
        //         error: function (xhr, ajaxOptions, thrownError) {

        //             console.log(xhr.responseJSON.errors)

        //             if(xhr.responseJSON.errors) {
        //                 $.each(xhr.responseJSON.errors, function (i, item) { 

    
        //                     field = '[name="' + i + '"]'
        //                     $(field).addClass('is-invalid').next().filter('.invalid-feedback').html(item)
        //                     $(field).addClass('is-invalid').next().next().filter('.invalid-feedback').html(item)
        //                 });
        //                 return
        //             }
        //             $('.alert', form).removeClass('d-none')
        //             $('#alert-text').html(xhr.responseText)
        //         }
        //     });
        // });









        // $(document).ready(function () {

        //     calendar = $('#calendar-class').fullCalendar({...config.fullcalendar,...{
        //             events: {
        //                 url: 'calendar/',
        //                 data: function() {
        //                     obj = {}
        //                     $('.item-calendar').each(function (index, element) {
        //                         name = $(this).attr('name');
        //                         obj[name] = $('[name="'+name+'"]').val()
        //                     });
        //                     return obj
        //                 }
        //             },

        //             eventDrop: function(info,  delta, revertFunc) {

                       
        
        //                 start = moment(new Date(info.raw.start)).format('YYYY-MM-DD')

        //                 if(info.raw.type != 'AE') {
        //                     if(start !== info.start.format('YYYY-MM-DD')) {
        //                     return    revertFunc();
        //                 }
        //                 }
                        




        //                 $.ajax({
        //                     type: "post",
        //                     url: 'class/'+info.id,
        //                     data: {
        //                         _method: 'put',
        //                         _token: '{{ csrf_token() }}',
        //                         date: info.start.format('YYYY-MM-DD'),
        //                         time: info.start.format('HH:mm:ss')   
        //                     },
        //                     success: function (response) {
        //                         refreshCalendar();
        //                     }
        //                 });

        //             },

        //             eventRender: function(event, element) {
        //                 element.find(".fc-title").html(event.title);
        //             },
        //             eventClick:  function(event, jsEvent, view) {
        //                 $('#context').remove()
        //                 if(!remark) {
        //                     showClass(event.id)
        //                 }
        //             },
        //             dayClick: function(date, jsEvent, view) {
        //                 $.ajax({
        //                     url: 'calendar/context/' + date.format(),
        //                     success: function(doc) {

        //                         console.log(jsEvent)

        //                         $('#context').remove()

        //                         $('body').append(doc);


        //                         $('#context .dismiss').click(function (e) { 
        //                             $('#context').remove()
        //                         });
     

        //                         $('#context').css('top',  (jsEvent.pageY) +  'px');
        //                         $('#context').css('left',  (jsEvent.pageX) +  'px');

                                
        //                     }
        //                 });
        //             },
                    
        //         }
        //     });

        //     $('.item-calendar').change(function (e) { 
        //         refreshCalendar();
        //     });
                    
        // });
</script>
@parent
@endsection