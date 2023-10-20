<div class="modal fade" id="modal-event-" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content p-2">
            <div class="modal-header bg-lights border-0">
                <h5 class="m-0">
                    <strong><i class="fas fa-calendar-alt    "></i> Renovar</strong>
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body pb-0">

                <div class="row mb-4">
                    <div class="col-auto">
                        <x-avatar class="elevation-2" :user="$registration->student->user" size="64px"></x-avatar>
                    </div>
                
                    <div class="col">
                     
                        <h5 class="mb-1">
                            <a href="{{ route('student.show', $registration->student) }}"><strong>{{ $registration->student->user->shortName }}</strong></a>
                        </h5>

                        
                        <span class="text-muted mt-1">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            {{ $registration->modality->name }} 
                        </span>
                        <span class="mx-2">|</span>

                        
            
                        <span class="text-muted mt-1">
                            <i class="fas fa-phone    "></i>
                            {{ $registration->student->user->phone_wpp }}
                        </span>
                 
                    
                    </div>
                
                
                </div>

                <a href="{{ route('student.registration.renew', [$registration->student, $registration]) }}">Renovar Matrícula</a>
                

            </div>

            <div class="modal-footer pt-1 border-0 ">


                <a href="#" class="mr-4 text-muted" data-dismiss="modal">
                    Fechar
                </a>



            </div>
        </div>
    </div>
</div>